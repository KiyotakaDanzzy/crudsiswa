<div class="container mt-4">
    <h2 class="mb-4">Tambah Data Siswa</h2>

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

    <?php echo form_open_multipart('siswa/simpan', 'class="needs-validation" novalidate'); ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nama" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
                <div class="invalid-feedback">
                    Harap isi nama siswa
                </div>
            </div>

            <div class="col-md-6">
                <label for="nis" class="form-label">NIS</label>
                <input type="number" class="form-control" name="nis" id="nis" required>
                <div class="invalid-feedback">
                    Harap isi NIS
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select" name="kelas" id="kelas" required>
                    <option value="" selected disabled>Pilih Kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
                <div class="invalid-feedback">
                    Harap pilih kelas
                </div>
            </div>

            <div class="col-md-6">
                <label for="jurusan" class="form-label">Jurusan</label>
                <select class="form-select" name="jurusan" id="jurusan" required>
                    <option value="" selected disabled>Pilih Jurusan</option>
                    <option value="RPL">Rekayasa Perangkat Lunak</option>
                    <option value="TKJ">Teknik Komputer dan Jaringan</option>
                    <option value="AK">Akuntansi</option>
                    <option value="MP">Manajemen Perkantoran</option>
                    <option value="BD">Bisnis Digital</option>
                </select>
                <div class="invalid-feedback">
                    Harap pilih jurusan
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
            <div class="invalid-feedback">
                Harap isi alamat
            </div>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            <small class="text-muted">Format: JPG/PNG</small>
            <?php if(isset($error)): ?>
                <small class="text-danger"><?= $error ?></small>
            <?php endif; ?>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="<?php echo site_url('siswa'); ?>" class="btn btn-secondary me-md-2">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
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