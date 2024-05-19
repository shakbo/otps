<div class="modal fade" id="authenticatortotpValidateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="authenticatortotpValidateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="authenticatortotpValidateModal">驗證器 TOTP 驗證</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="authenticatortotpValidateForm" method="post" class="needs-validation" action="assets/script/otp/validate/authenticator.php" novalidate>
                    <div class="mb-3">
                        <label for="otp-password" class="form-label">驗證碼</label>
                        <input type="text" class="form-control" id="otp-password" name="otp-password" data-v-min-length="6" data-v-max-length="6" required>
                    </div>
                    <button type="submit" form="authenticatortotpValidateForm" class="btn btn-primary w-100">送出</button>
                </form>
                <form id="regenerateForm" method="post" action="assets/script/otp/regenerate.php">
                    <button type="submit" form="regenerateForm" class="btn btn-secondary w-100 mt-2">重新產生</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mx-auto">還沒綁定驗證器? <a class="hyperlink" href="#" data-bs-toggle="modal" data-bs-target="#qrCodeModal">立即綁定</a>。</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(function (){
        let validator = $('.needs-validation').jbvalidator({
            errorMessage: true,
            successClass: true,
            language: 'assets/library/jbvalidator/lang/zh.json'
        });

        validator.reload();
    })
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/assets/component/modal/qrcode.php');
?>