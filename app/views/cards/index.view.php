<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="modal-wrapper">
        <div class="modal" id="add-card-modal">
            <div class="modal__header">
                <h2>Add New Card</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal__body">
                <form class="form form--modal">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id']; ?>">
                    <div class="form__group">
                        <input class="form__input" type="text" name="card_name" id="card_name" value="<?= $data['card_name']; ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="card_name">Card Name </label>
                        <small class="form__error" id="card_name_err"></small>
                    </div>
                    <div class="form__group">
                        <select class="form__input" type="text" name="company" id="company" value="<?= $data['company']; ?>">
                            <option value="0">--Choose your card type--</option>
                            <option value="visa">Visa</option>
                            <option value="master">Master Card</option>
                            <option value="express">American Express</option>
                            <option value="other">Other</option>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="company">Type </label>
                        <small class="form__error" id="company_err"></small>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="text" name="last_digit" id="last_digit" value="<?= $data['last_digit']; ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="last_digit">Last 4 Digit </label>
                        <small class="form__error" id="last_digit_err"></small>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="text" name="expire" id="expire" value="<?= $data['expire']; ?>">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label class="form__label" for="expire">Expiration Date (mm-yy)</label>
                            <small class="form__error" id="expire_err"></small>
                    </div>
                    <input name="add_card" id="add-card" class="btn" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>

    <div class="grid">
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>
        <div class="col-6">
            <div class="module">
                <?= flash('connection_error'); ?>
                <div class="panel">
                    <div class="panel__heading">Cards Information</div>
                    <div class="panel__body">
                        <ul class="list">
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="images/credit_card_logo.png">
                                </div>
                                <div class="list__title">
                                    <h3>My Card</h3>
                                    <p><span><em>2951</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>11/20</span></p>
                                    <button class="list__top-btn" rel="js-editCardBtn">Edit</button>
                                </div>
                            </li>
                            <li class="list__item">
                                <div class="list__logo">
                                <img src="images/credit_card_logo.png">
                                </div>
                                <div class="list__title">
                                <h3>My Card</h3>
                                    <p><span><em>2951</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>11/20</span></p>
                                    <button class="list__top-btn" rel="js-payBtn">Edit</button>
                                </div>
                            </li>
                            <button class="list__add-btn" rel="js-modal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-3">
            <div class="module module--empty"></div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>