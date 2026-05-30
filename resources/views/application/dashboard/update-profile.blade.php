<style>
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }

    .avatar-upload {
        position: relative;
        max-width: 150px;
        margin: 0 auto;
    }

    .avatar-preview {
        width: 150px;
        height: 150px;
        position: relative;
        border-radius: 100%;
        border: 4px solid #fff;
        box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .avatar-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-edit {
        position: absolute;
        right: 5px;
        bottom: 5px;
        z-index: 1;
    }

    .avatar-edit input {
        display: none;
    }

    .avatar-edit label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #0d6efd;
        color: #fff;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-edit label:hover {
        background: #0b5ed7;
    }
</style>
<div class="card profile-card bg-white p-4 p-md-5">

    <div id="alertContainer"></div>

    <form id="profileForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4 text-center border-end mb-4 mb-md-0 pe-md-4" style="border-color: #dee2e6 !important;">
                <h4 class="fw-bold text-dark mb-4">Foto Profil</h4>

                <div class="avatar-upload mb-3">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"><i class="bi bi-pencil-fill"></i></label>
                    </div>
                    <div class="avatar-preview">
                        @php
                        $bio = DB::table('tbl_biodata')->where('id_user',Auth::user()->id_user)->first();
                        @endphp
                        @if ($bio)
                        <img id="imagePreview" src="{{ $bio->gambar ? asset('storage/' . $bio->gambar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&size=150&background=0D6EFD&color=fff' }}" alt="Profile Preview">
                        @else
                        <img id="imagePreview" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&size=150&background=0D6EFD&color=fff' }}" alt="Profile Preview">
                        @endif
                    </div>
                </div>
                <p class="text-muted small">Format: JPG, JPEG, atau PNG. Maksimal 2MB.</p>
            </div>

            <div class="col-md-8 ps-md-4">
                <h4 class="fw-bold text-dark mb-4">Informasi Pribadi</h4>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="fullName" class="form-label text-secondary small fw-bold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person text-muted"></i></span>
                            <input type="text" class="form-control" id="fullName" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="username" class="form-label text-secondary small fw-bold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">@</span>
                            <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->email }}" required disabled>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label text-secondary small fw-bold">Nomor Handphone / Whatsapp</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-telephone text-muted"></i></span>
                            <input type="tel" class="form-control" id="phone" name="phone_number" value="{{ Auth::user()->phone_number }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="bio" class="form-label text-secondary small fw-bold">Bio Singkat</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Ceritakan sedikit tentang diri Anda..." disabled>{{ Auth::user()->bio }}</textarea>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-light px-4">Batal</button>
                        <button type="submit" id="btnSubmit" class="btn btn-primary px-4">
                            <span id="btnText">Simpan Perubahan</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<script>
    // 1. Live Preview Gambar saat File Dipilih
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar! Maksimal 2MB.');
                this.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // 2. Kirim data Form via AJAX Fetch ke Laravel
    document.getElementById('profileForm').addEventListener('submit', async function(event) {
        event.preventDefault();

        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        const btnSpinner = document.getElementById('btnSpinner');
        const alertContainer = document.getElementById('alertContainer');

        // Nyalakan Loading Spinner
        btnSubmit.disabled = true;
        btnText.classList.add('d-none');
        btnSpinner.classList.remove('d-none');

        // Bungkus semua input (termasuk file gambar) ke FormData
        const formData = new FormData(this);

        try {
            const response = await fetch("{{ route('dashboard_home_update_profile_save') }}", {
                method: "POST",
                body: formData,
                headers: {
                    // Jangan set Content-Type secara manual saat menggunakan FormData agar file tidak rusak
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const result = await response.json();

            if (response.ok && result.success) {
                Swal.fire('Berhasil!', result.message, 'success').then(() => {
                    location.reload();
                });
                // Sinkronisasi ulang preview gambar dengan URL storage asli yang dikirim server
                if (result.avatar_url) {
                    document.getElementById('imagePreview').src = result.avatar_url;
                }
            } else {
                Swal.fire('Gagal!', result.message, 'error').then(() => {
                    location.reload();
                });
            }
        } catch (error) {
            Swal.fire('Gagal!', result.message, 'error').then(() => {
                location.reload();
            });
        } finally {
            // Matikan Loading Spinner
            btnSubmit.disabled = false;
            btnText.classList.remove('d-none');
            btnSpinner.classList.add('d-none');
        }
    });
</script>
