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
                    <div class="form__group">
                        <input class="form__input" type="email" name="email" id="email" value="<?= $data['email']; ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="email">Email </label>
                        <?php if(!empty($data['email_err'])): ?>
                            <small class="form__error"><?= $data['email_err']; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="password" name="password" id="password">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="password">Password </label>
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
<?php include APPROOT.'/views/inc/footer.php'; ?>