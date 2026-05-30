<style>
    .change-pass-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }

    .verification-box {
        /* background-color: white; */
        border-radius: 10px;
        border: 1px dashed #0d79e5;
    }

    .input-group-text {
        cursor: pointer;
    }
</style>
<div class="card change-pass-card p-4 p-md-5">

    <div class="d-flex align-items-center mb-2">
        <div class="bg-300 text-primary rounded-3 p-3 me-3">
            <i class="fab fa-keycdn fs-3"></i>
        </div>
        <div>
            <h4 class="fw-bold text-dark mb-0">Ubah Password Akun</h4>
            <p class="text-muted small mb-0">Masukkan password baru Anda dan lakukan verifikasi OTP.</p>
        </div>
    </div>

    <hr class="text-muted opacity-25 mb-4">

    <div id="alertContainer"></div>

    <form id="changePasswordForm" onsubmit="processChangePassword(event)">

        <div class="mb-3">
            <label for="newPassword" class="form-label text-secondary small fw-bold">Password Baru</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-key text-muted"></i></span>
                <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="Minimal 8 karakter" required minlength="8" autocomplete>
                <span class="input-group-text bg-light" onclick="togglePassword('newPassword', this)">
                    <i class="fas fa-eye-slash text-muted"></i>
                </span>
            </div>
        </div>

        <div class="mb-4">
            <label for="confirmPassword" class="form-label text-secondary small fw-bold">Konfirmasi Password Baru</label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-check-double text-muted"></i></span>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Ulangi password baru" required autocomplete>
                <span class="input-group-text bg-light" onclick="togglePassword('confirmPassword', this)">
                    <i class="fas fa-eye-slash text-muted"></i>
                </span>
            </div>
        </div>

        <div class="p-3 mb-4 verification-box">
            <label class="form-label text-dark small fw-bold mb-1">Verifikasi OTP</label>
            <p class="text-muted small mb-3">Klik tombol di bawah untuk menerima kode keamanan pada nomor HP Anda yang terdaftar. {{ Auth::user()->phone_number }}</p>

            <div class="row g-2">
                <div class="col-7 col-sm-8">
                    <input type="text" class="form-control" id="verificationCode" name="otp_code" placeholder="Masukkan kode 6-digit" required disabled maxlength="6">
                </div>
                <div class="col-5 col-sm-4">
                    <button type="button" id="sendCodeBtn" class="btn btn-outline-primary w-100 fw-bold btn-sm h-100" onclick="sendVerificationCode()">
                        <span id="btnRequestText">Kirim OTP</span>
                        <span id="btnRequestSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                    </button>
                </div>
            </div>
            <div id="countdownText" class="form-text text-muted small mt-2 d-none">
                Kirim ulang OTP dalam <span id="timer" class="fw-bold">120</span> detik.
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-light px-4">Batal</button>
            <button type="submit" id="submitBtn" class="btn btn-primary px-4 fw-bold" disabled>
                <span id="btnSubmitText">Simpan Password</span>
                <span id="btnSubmitSpinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
            </button>
        </div>

    </form>

</div>
