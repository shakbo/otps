<div class="container-fluid text-center">
    <div class="row">
        <div class="title">
            <p class="h1 text-center py-3">透過簡訊獲取 OTP</p>
        </div>
    </div>
    <div class="row">
        <div class="card-outbox col d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="assets/image/hash.svg" class="card-img-top p-3" alt="hotp">
                <div class="card-body">
                    <h5 class="card-title">HOTP</h5>
                    <p class="card-text">HMAC-based One-time Password</p>
                    <button type="button" id="sendhotp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#hotpValidateModal">展示一下</button>
                </div>
            </div>
        </div>
        <div class="card-outbox col d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="assets/image/clock.svg" class="card-img-top p-3" alt="totp">
                <div class="card-body">
                    <h5 class="card-title">TOTP</h5>
                    <p class="card-text">Time-based One-time password</p>
                    <button type="button" id="sendtotp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#totpValidateModal">展示一下</button>
                </div>
            </div>
        </div>
        <div class="card-outbox col d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
                <img src="assets/image/dice.svg" class="card-img-top p-3" alt="totp">
                <div class="card-body">
                    <h5 class="card-title">隨機數OTP</h5>
                    <p class="card-text">Random number One-time password</p>
                    <button type="button" id="sendrandomnumberotp" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#randomnumberotpValidateModal">展示一下</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function sendRequest(buttonId, phpFile) {
  document.getElementById(buttonId).addEventListener("click", function() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", phpFile, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
      if (this.status >= 200 && this.status < 400) {
        console.log(this.responseText); 
      } else {
        console.error("Error: " + this.status);
      }
    };

    xhr.onerror = function() {
      console.error("Request failed");
    };

    xhr.send("button_clicked=true"); 
  });
}

sendRequest("sendhotp", "assets/script/otp/send/hotp.php");
sendRequest("sendtotp", "assets/script/otp/send/totp.php");
sendRequest("sendrandomnumberotp", "assets/script/otp/send/randomNumber.php");
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/otp/hotp.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/otp/totp.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/otp/randomnumberotp.php');
?>