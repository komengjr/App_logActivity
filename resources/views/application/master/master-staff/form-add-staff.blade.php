<div class="modal-body p-0">
    <div class="bg-primary rounded-top-lg py-3 ps-4 pe-6">
        <h4 class="mb-1" style="color: white;" id="staticBackdropLabel">Form add Data Petugas Cabang</h4>
        <p class="fs--2 mb-0" style="color: white;">Support by <a class="link-600 fw-semi-bold" href="#!">Transforma</a>
        </p>
    </div>
    <div class="p-4 pb-3" id="menu-add-data-pr-all">
        <form class="row g-3 pb-3" id="form-add-petugas-cabang" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP (Opsional)">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="no_hp" class="form-label">No. HP / WhatsApp</label>
                    <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567xxx">
                </div>

                <div class="col-md-4 mb-3">
                    <label for="kd_cabang" class="form-label">Pilih Cabang <span class="text-danger">*</span></label>
                    <select class="form-select js-choice" id="kd_cabang" name="kd_cabang" required>
                        <option value="" selected disabled>-- Pilih Cabang --</option>
                        @foreach ($cabang as $cab)
                        <option value="{{ $cab->kd_cabang }}">{{ $cab->nama_cabang }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kd_cabang" class="form-label">Pilih Akses <span class="text-danger">*</span></label>
                    <select class="form-select js-choice" id="akses" name="akses" required>
                        <option value="" selected disabled>-- Pilih Cabang --</option>
                        <option value="3">User Leader</option>
                        <option value="4">User Biasa</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap..."></textarea>
            </div>

            <!-- <div class="mb-4">
                <label for="gambar" class="form-label">Upload Gambar / Foto</label>
                <input class="form-control" type="file" id="gambar" name="gambar" accept="image/*">
                <div class="form-text">Format yang diperbolehkan: JPG, PNG, atau JPEG.</div>
            </div> -->

        </form>
    </div>
</div>
<div class="modal-footer px-4 bg-300">
    <button type="reset" class="btn btn-secondary">Reset</button>
    <span id="menu-add-data-petugas">
        <button class="btn btn-success float-end" id="button-simpan-data-petugas" data-code="">Simpan
            Data</button>
    </span>
</div>
