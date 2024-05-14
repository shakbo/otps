<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img src='assets/image/logo.svg' alt="Logo" width="auto" height="36" class="d-inline-block align-text-top">
            OTPs
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-3">
                    <a class="nav-link active" aria-current="page" href="index.php">首頁</a>
                </li>
                <li class="nav-item mx-3 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        功能
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item disabled" href="#">簡訊型(SMS)</a></li>
                        <li><a class="dropdown-item disabled" href="#">時間型(Time)</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <?php if(isset($showLogin) && $showLogin): ?>
                            <script src="assets/library/jquerry/jquery-3.7.1.js"></script>
                            <script src="assets/library/jbvalidator/jbvalidator.js"></script>
                            <li><a class="dropdown-item" href='#' data-bs-toggle="modal" data-bs-target="#loginModal">請先登入</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item disabled" href='#'>請先登入</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#">關於</a>
                </li>
            </ul>
            <?php if(isset($showLogin) && $showLogin): ?>
                    <button type="button" class="btn btn-outline-primary nav-item" data-bs-toggle="modal" data-bs-target="#loginModal">登入</button>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php 
if(isset($showLogin) && $showLogin):
    include_once(".\assets\component\modal\login.php");
    include_once(".\assets\component\modal\signup.php");
    include_once(".\assets\component\modal\\recovery.php");
endif; 
?>