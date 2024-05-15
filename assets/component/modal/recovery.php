<div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="recoveryModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="recoveryModal">尋回帳號</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recoveryForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="recoveryInputEmail" class="form-label">使用者名稱</label>
                        <input type="text" class="form-control" id="recoveryInputEmail" name="email" required>
                    </div>
                    <button type="submit" form="recoveryForm" class="btn btn-primary w-100">送出</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center mx-auto">已經有帳號了？<a class="hyperlink" href="#" data-bs-target="#loginModal" data-bs-toggle="modal">立即登入</a>。</p>
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