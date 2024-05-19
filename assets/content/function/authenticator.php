<div class="container-fluid text-center">
    <div class="row">
        <div class="title">
            <p class="h1 text-center py-3">透過驗證器獲取 OTP</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="card-2 col-sm-6 d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="assets/image/clock.svg" class="card-img-top p-3" alt="totp">
                <div class="card-body">
                    <h5 class="card-title">TOTP</h5>
                    <p class="card-text">Time-based One-time password</p>
                    <button type="button" id="authenticatortotp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authenticatortotpValidateModal">展示一下</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/otp/authenticatortotp.php');
?>