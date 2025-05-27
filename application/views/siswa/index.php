<div class="container mt-4">
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="mb-0">Daftar Siswa</h2>
    </div>
    <div class="col-md-6">
        <form action="<?= site_url('siswa') ?>" method="get">
            <div class="input-group">
                <input type="text"
                    class="form-control border-primary shadow-sm"
                    name="search"
                    placeholder="Cari siswa..."
                    value="<?= isset($keyword) ? $keyword : '' ?>">
                
                <button class="btn btn-primary border-primary shadow-sm" type="submit">
                    <i class="fas fa-search"></i>
                </button>
                
                <?php if (!empty($keyword)): ?>
                    <a href="<?= site_url('siswa') ?>" class="btn btn-outline-secondary border-primary shadow-sm">
                        <i class="fas fa-times"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($siswa as $s): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php
                            $foto_path = 'uploads/' . $s->foto;
                            $full_path = FCPATH . $foto_path;

                            if (!empty($s->foto) && file_exists($full_path)):
                            ?>
                                <img src="<?= base_url($foto_path) ?>"
                                    width="100"
                                    height="100"
                                    class="rounded-circle"
                                    style="object-fit: cover;"
                                    alt="Foto <?= htmlspecialchars($s->nama) ?>">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/profil_basic.jpg') ?>"
                                    width="100"
                                    height="100"
                                    class="rounded-circle"
                                    style="object-fit: cover;"
                                    alt="Foto Default">
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($s->nama); ?></td>
                        <td><?php echo htmlspecialchars($s->nis); ?></td>
                        <td><?php echo htmlspecialchars($s->kelas); ?></td>
                        <td>
                            <?php
                            $jurusan = [
                                'RPL' => 'Rekayasa Perangkat Lunak',
                                'TKJ' => 'Teknik Komputer dan Jaringan',
                                'AK' => 'Akuntansi',
                                'MP' => 'Manajemen Perkantoran',
                                'BD' => 'Bisnis Digital',
                            ];
                            echo $jurusan[$s->jurusan] ?? $s->jurusan;
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($s->alamat); ?></td>
                        <td>
                            <div class="btn-group gap-3" role="group">
                                <a href="<?php echo site_url('siswa/edit/' . $s->id); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?php echo site_url('siswa/hapus/' . $s->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

