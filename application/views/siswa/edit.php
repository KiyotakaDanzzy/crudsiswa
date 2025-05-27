<div class="container mt-4">
    <h2 class="mb-4">Edit Data Siswa</h2>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo validation_errors(); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php echo form_open_multipart('siswa/update/' . $siswa->id, 'class="needs-validation" novalidate'); ?>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="nama" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" name="nama" id="nama"
                value="<?php echo set_value('nama', $siswa->nama); ?>" required>
            <div class="invalid-feedback">
                Harap isi nama siswa
            </div>
        </div>

        <div class="col-md-6">
            <label for="nis" class="form-label">NIS</label>
            <input type="number" class="form-control" name="nis" id="nis"
                value="<?php echo set_value('nis', $siswa->nis); ?>" required>
            <div class="invalid-feedback">
                Harap isi NIS
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select" name="kelas" id="kelas" required>
                <option value="X" <?php echo set_select('kelas', 'X', ($siswa->kelas == 'X')); ?>>X</option>
                <option value="XI" <?php echo set_select('kelas', 'XI', ($siswa->kelas == 'XI')); ?>>XI</option>
                <option value="XII" <?php echo set_select('kelas', 'XII', ($siswa->kelas == 'XII')); ?>>XII</option>
            </select>
            <div class="invalid-feedback">
                Harap pilih kelas
            </div>
        </div>

        <div class="col-md-6">
            <label for="jurusan" class="form-label">Jurusan</label>
            <select class="form-select" name="jurusan" id="jurusan" required>
                <option value="RPL" <?php echo set_select('jurusan', 'RPL', ($siswa->jurusan == 'RPL')); ?>>Rekayasa Perangkat Lunak</option>
                <option value="TKJ" <?php echo set_select('jurusan', 'TKJ', ($siswa->jurusan == 'TKJ')); ?>>Teknik Komputer dan Jaringan</option>
                <option value="AK" <?php echo set_select('jurusan', 'AK', ($siswa->jurusan == 'AK')); ?>>Akuntansi</option>
                <option value="MP" <?php echo set_select('jurusan', 'MP', ($siswa->jurusan == 'MP')); ?>>Manajemen Perkantoran</option>
                <option value="BD" <?php echo set_select('jurusan', 'BD', ($siswa->jurusan == 'BD')); ?>>Bisnis Digital</option>
            </select>
            <div class="invalid-feedback">
                Harap pilih jurusan
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" id="alamat"
            value="<?php echo set_value('alamat', $siswa->alamat); ?>" required>
        <div class="invalid-feedback">
            Harap isi alamat
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto Saat Ini</label>
        <?php if (!empty($siswa->foto)): ?>
            <div class="mb-2">
                <img src="<?= base_url('uploads/' . $siswa->foto) ?>" width="100" class="img-thumbnail mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remove_foto" id="remove_foto" value="1">
                    <label class="form-check-label" for="remove_foto">
                        Hapus foto saat ini
                    </label>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada foto</p>
        <?php endif; ?>

        <label for="foto" class="form-label">Ubah Foto</label>
        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG/PNG (max 10MB)</small>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="<?php echo site_url('siswa'); ?>" class="btn btn-secondary me-md-2">
            <i class="fas fa-times"></i> Batal
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Update
        </button>
    </div>
    </form>
</div>

<script>
    (function() {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>