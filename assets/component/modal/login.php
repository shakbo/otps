<?php
include_once "./config.php";
if (isset($_POST['login'])) {
    $email = $_POST['email'];
}
?>

<script>
    $(function (){
        let validator = $('.needs-validation').jbvalidator({
            errorMessage: true,
            successClass: true,
            language: 'assets/library/jbvalidator/lang/zh.json'
        });

        validator.validator.example = function(el, event){
            if($(el).is('[name=loginInputEmail]') && $(el).val().length < 3){
                return 'Your username is too short.';
            }
        }

        //custom validate methode
        validator.validator.custom = function(el, event){
            if($(el).is('[name=loginInputPassword]') && $(el).val().length < 5){
                return 'Your password is too weak.';
            }
        }

        //check form without submit
        validator.checkAll(); //return error count

        //reload instance after dynamic element is added
        validator.reload();
    })
</script>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="loginModal">登入帳號</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loginForm" method="post" class="needs-validation" novalidate action="#">
                    <div class="mb-3 has-validation">
                        <label for="loginInputEmail" class="form-label">電子郵件地址</label>
                        <input type="email" class="form-control" id="loginInputEmail" name="loginInputEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginInputPassword" class="form-label has-validation">密碼</label>
                        <input type="password" pattern="[a-zA-Z0-9]{8,}" class="form-control" id="loginInputPassword" name="loginInputPassword" required>
                    </div>
                    <button type="submit" form="loginForm" class="btn btn-primary mb-3 w-100">登入</button>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberCheck">
                        <label class="form-check-label" for="rememberCheck">記住登入資訊</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer d-flex flex-column">
                <a class="hyperlink text-center mx-auto" href="#" data-bs-target="#recoveryModal" data-bs-toggle="modal">忘記密碼？</a>
                <hr>
                <p class="text-center mx-auto use-for-login-form">還未擁有帳號？<a class="hyperlink" href="#" data-bs-target="#signupModal" data-bs-toggle="modal">立即註冊</a>。</p>
            </div>
        </div>
    </div>
</div>