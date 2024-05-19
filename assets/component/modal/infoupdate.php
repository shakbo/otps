<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT `username`, `email`, `phoneNumber` FROM `users` WHERE `id` = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);
?>

<div class="modal fade" id="infoUpdateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="infoUpdateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="infoUpdateModal">帳號資訊更新</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="infoUpdateForm" method="post" action="assets/script/validation/infoUpdate.php" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="infoUpdateInputUsername" class="form-label">使用者名稱</label>
                        <input type="text" class="form-control" id="infoUpdateInputUsername" name="username" data-v-min-length="3" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="infoUpdateInputEmail" class="form-label">電子郵件地址</label>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" id="infoUpdateInputEmail" name="email" data-v-min-length="3" value="<?php echo $row['email']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="infoUpdateInputphoneNumber" class="form-label">電話號碼</label>
                        <input type="tel" pattern="\+886[0-9]{9}" class="form-control" id="infoUpdateInputphoneNumber" name="phoneNumber" placeholder="+886123456789" data-v-min-length="3" value="<?php echo $row['phoneNumber']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="infoUpdateInputPassword" class="form-label">密碼</label>
                        <input type="password" pattern="(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])\S{6,}" class="form-control" id="infoUpdateInputPassword" name="password" required>
                    </div>
                    <button type="submit" form="infoUpdateForm" class="btn btn-primary w-100">更新</button>
                </form>
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