<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="grid">
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>
        <div class="col-6">
            <div class="module">
                <?= flash('login_success'); ?>
                <?= flash('connection_error'); ?>
                <h1 style="text-align:center;line-height:48px;">MVC Framework - by Deakyu Lee</h1>
                <h4 style="text-align:center;">Built on top of Traversy MVC framework</h4>
            </div>
        </div>
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>