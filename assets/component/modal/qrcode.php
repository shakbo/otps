<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/otps/configs/database.php');

$id = $_SESSION['SES']['id'];

$sqlCommand = "SELECT u.email, k.totp FROM users u JOIN keypairs k ON u.keypairs = k.id WHERE u.id = $id";
$result = mysqli_query($sqlConnection, $sqlCommand);
$row = mysqli_fetch_assoc($result);

$email = $row['email'];
$secret = $row['totp'];

$qrcontent = "otpauth://totp/OTPs:".$email."?secret=".$secret."&issuer=OTPs";
?>

<div class="modal fade" id="qrCodeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="qrCodeModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="qrCodeModal">TOTP金鑰</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <img src=<?php echo "https://api.qrserver.com/v1/create-qr-code/?data=$qrcontent&size=256x256" ?>/>
            </div>
            <div class="modal-footer d-flex flex-column">
                <hr>
                <p class="text-center mx-auto">或手動輸入金鑰: </p>
                <p class="text-center mx-auto"><?php echo $secret; ?></p>
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