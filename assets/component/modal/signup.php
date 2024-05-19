<div class="modal fade" id="signupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="signupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="signupModal">註冊帳號</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="signUpForm" method="post" action="assets/script/validation/signUp.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="signUpInputUsername" class="form-label">使用者名稱</label>
                        <input type="text" class="form-control" id="signUpInputUsername" name="username" data-v-min-length="3" required>
                    </div>
                    <div class="mb-3">
                        <label for="signUpInputEmail" class="form-label">電子郵件地址</label>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="signUpInputEmail" name="email" data-v-min-length="3" required>
                    </div>
                    <div class="mb-3">
                        <label for="signUpInputPassword" class="form-label">密碼</label>
                        <input type="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" class="form-control" id="signUpInputPassword" name="password" data-v-equal="#signUpInputConfirmPassword" data-v-message="密碼不符合要求或不一致" required>
                    </div>
                    <div class="mb-3">
                        <label for="signUpInputConfirmPassword" class="form-label">確認密碼</label>
                        <input type="password" class="form-control" id="signUpInputConfirmPassword" name="confirmPassword" data-v-equal="#signUpInputPassword" data-v-message="密碼不一致" required>
                    </div>
                    <button type="submit" form="signUpForm" class="btn btn-primary w-100">註冊</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mx-auto">已經有帳號了？<a class="hyperlink" href="#" data-bs-target="#loginModal" data-bs-toggle="modal">立即登入</a>。</p>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        let validator = $('.needs-validation').jbvalidator({
            errorMessage: true,
            successClass: true,
            language: 'assets/library/jbvalidator/lang/zh.json'
        });

        let passwordTimeout = null;

        validator.validator.custom = function(el, event) {
            if ($(el).is('[name=password]') || $(el).is('[name=confirmPassword]')) {
            clearTimeout(passwordTimeout);

            passwordTimeout = setTimeout(() => {
                validator.checkAll();
                validator.reload();
            }, 500);
            }
        };

        validator.reload();
    });
</script>