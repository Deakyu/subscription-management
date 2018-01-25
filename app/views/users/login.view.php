<?php include APPROOT.'/views/inc/header.php'; ?>
    <div class="grid">
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>   
        <div class="col-6">
            <div class="module">
                <?= flash('register_success'); ?>
                <form class="form" action="<?= URLROOT.'/user/login'; ?>" method="post">
                    <h1 class="form__title">Login</h1>
                    <input type="hidden" name="timezone" id="timezone">
                    <div class="form__group">
                        <label class="form__label" for="email">Email </label>
                        <input class="form__input" type="email" name="email" id="email" value="<?= $data['email']; ?>">
                        <?php if(!empty($data['email_err'])): ?>
                            <small class="form__error"><?= $data['email_err']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="password">Password </label>
                        <input class="form__input" type="password" name="password" id="password">
                        <?php if(!empty($data['password_err'])): ?>
                            <small class="form__error"><?= $data['password_err']; ?></small>
                        <?php endif; ?>
                    </div>
                    
                    <a style="display:block;text-align:center;text-decoration:underline;color:#5246ae;" href="<?= URLROOT.'/user/register'; ?>" style="color:white;">Have an account yet? Register!</a>
                 
                    <input class="btn" type="submit" value="sign in">
                </form>
            </div>
        </div>
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>    
    </div>
<?php require APPROOT . '/views/inc/js.php'; ?>
<!-- Put Custom js -->
<script>
    // Set timezone input for session use when logged in
    window.onload = () => {
        document.getElementById('timezone').value = tz
    }
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>