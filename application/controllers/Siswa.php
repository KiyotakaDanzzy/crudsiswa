<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Input $input
 * @property Siswa_model $Siswa_model
 * @property CI_Upload $upload
 * @property CI_Form_validation $form_validation
 * @property CI_Session $session
 */
class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'upload']);
    }

    public function index()
    {
        $keyword = $this->input->get('search');
        $data['siswa'] = !empty($keyword) ?
            $this->Siswa_model->search($keyword) :
            $this->Siswa_model->get_all();

        $data['keyword'] = $keyword;

        $this->load->view('page/header');
        $this->load->view('siswa/index', $data);
        $this->load->view('page/footer');
    }

    public function tambah()
    {
        $this->load->view('page/header');
        $this->load->view('siswa/tambah');
        $this->load->view('page/footer');
    }

    public function simpan()
    {
        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => 10240, 
            'max_width' => 3840,
            'max_height' => 3840,
            'encrypt_name' => true 
        ];

        $this->upload->initialize($config);

        $this->form_validation->set_rules('nama', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->tambah();
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nis' => $this->input->post('nis'),
                'kelas' => $this->input->post('kelas'),
                'jurusan' => $this->input->post('jurusan'),
                'alamat' => $this->input->post('alamat'),
                'foto' => null
            ];

            if ($this->upload->do_upload('foto')) {
                $data['foto'] = $this->upload->data('file_name');
            } elseif (!empty($_FILES['foto']['name'])) {
                $error = ['error' => $this->upload->display_errors()];
                return $this->load->view('page/header')
                    ->view('siswa/tambah', $error)
                    ->view('page/footer');
            }

            $this->Siswa_model->save($data);
            redirect('siswa');
        }
    }

    public function edit($id)
    {
        $data['siswa'] = $this->Siswa_model->get_by_id($id);
        $this->load->view('page/header');
        $this->load->view('siswa/edit', $data);
        $this->load->view('page/footer');
    }

    public function update($id)
    {
        $current_data = $this->Siswa_model->get_by_id($id);
        
        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => 10240,
            'max_width' => 3840,
            'max_height' => 3840,
            'encrypt_name' => true
        ];

        $this->upload->initialize($config);

        $this->form_validation->set_rules('nama', 'Nama Siswa', 'required');
        $this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nis' => $this->input->post('nis'),
                'kelas' => $this->input->post('kelas'),
                'jurusan' => $this->input->post('jurusan'),
                'alamat' => $this->input->post('alamat')
            ];

            // Handle photo deletion
            if ($this->input->post('remove_foto')) {
                if (!empty($current_data->foto) && file_exists('./uploads/' . $current_data->foto)) {
                    unlink('./uploads/' . $current_data->foto);
                }
                $data['foto'] = null;
            }
            // Handle new photo upload
            elseif (!empty($_FILES['foto']['name'])) {
                if ($this->upload->do_upload('foto')) {
                    // Delete old photo if exists
                    if (!empty($current_data->foto) && file_exists('./uploads/' . $current_data->foto)) {
                        unlink('./uploads/' . $current_data->foto);
                    }
                    $data['foto'] = $this->upload->data('file_name');
                } else {
                    $error = ['error' => $this->upload->display_errors()];
                    $data['siswa'] = $current_data;
                    return $this->load->view('page/header')
                        ->view('siswa/edit', array_merge($data, $error))
                        ->view('page/footer');
                }
            }

            $this->Siswa_model->update($id, $data);
            redirect('siswa');
        }
    }

    public function hapus($id)
    {
        $siswa = $this->Siswa_model->get_by_id($id);
        if (!empty($siswa->foto) && file_exists('./uploads/' . $siswa->foto)) {
            unlink('./uploads/' . $siswa->foto);
        }
        $this->Siswa_model->delete($id);
        redirect('siswa');
    }
}