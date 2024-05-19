<div class="modal fade" id="randomnumberotpValidateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="randomnumberotpValidateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="randomnumberotpValidateModal">隨機數OTP 驗證</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="randomnumberotpValidateForm" method="post" class="needs-validation" action="assets/script/otp/validate/randomNumber.php" novalidate>
                    <div class="mb-3">
                        <label for="otp-password" class="form-label">驗證碼</label>
                        <input type="text" class="form-control" id="otp-password" name="otp-password" data-v-min-length="6" data-v-max-length="6" required>
                    </div>
                    <button type="submit" form="randomnumberotpValidateForm" class="btn btn-primary w-100">送出</button>
                </form>
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