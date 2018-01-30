<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="modal-wrapper" id="add-card-modal-wrapper">
        <div class="modal" id="add-card-modal">
            <div class="modal__header">
                <h2>Add New Card</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal__body">
                <form class="form form--modal">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id']; ?>">
                    <div class="form__group">
                        <label class="form__label" for="card_name">Card Name </label>
                        <input class="form__input" type="text" name="card_name" id="card_name">
                        <small class="form__error" id="card_name_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="company">Type </label>
                        <select class="form__input" type="text" name="company" id="company">
                            <option value="0">--Choose your card type--</option>
                            <option value="visa">Visa</option>
                            <option value="master">Master Card</option>
                            <option value="express">American Express</option>
                            <option value="other">Other</option>
                        </select>
                        <small class="form__error" id="company_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="last_digit">Last 4 Digit </label>
                        <input class="form__input" type="text" name="last_digit" id="last_digit">
                        <small class="form__error" id="last_digit_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="expire">Expiration Date (mm-yy)</label>
                        <input class="form__input" type="text" name="expire" id="expire">
                        <small class="form__error" id="expire_err"></small>
                    </div>
                    <input name="add_card" id="save-card" class="btn" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>

    <div class="modal-wrapper" id="edit-card-modal-wrapper">
        <div class="modal" id="edit-card-modal">
            <div class="modal__header">
                <h2>Edit Card Information</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal__body">
                <form class="form form--modal">
                    <input type="hidden" name="user_id" id="edit_user_id" value="<?= $_SESSION['user_id']; ?>">
                    <div class="form__group">
                        <label class="form__label" for="card_name">Card Name </label>
                        <input class="form__input" type="text" name="card_name" id="edit_card_name">
                        <small class="form__error" id="edit_card_name_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="company">Type </label>
                        <select class="form__input" type="text" name="company" id="edit_company">
                            <option value="0">--Choose your card type--</option>
                            <option value="visa">Visa</option>
                            <option value="master">Master Card</option>
                            <option value="express">American Express</option>
                            <option value="other">Other</option>
                        </select>
                        <small class="form__error" id="edit_company_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="last_digit">Last 4 Digit </label>
                        <input class="form__input" type="text" name="last_digit" id="edit_last_digit">
                        <small class="form__error" id="edit_last_digit_err"></small>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="expire">Expiration Date (mm-yy)</label>
                        <input class="form__input" type="text" name="expire" id="edit_expire">
                        <small class="form__error" id="edit_expire_err"></small>
                    </div>
                    <input id="update-card" class="btn" type="submit" value="Update">
                    <input id="delete-card" class="btn btn--danger" type="submit" value="Delete">
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
                            <?php if(!empty($data)): ?>
                                <?php foreach($data as $card): ?>
                                    <li class="list__item">
                                        <div class="list__logo">
                                            <img src="<?= $card->company; ?>">
                                        </div>
                                        <div class="list__title">
                                            <h3><?= $card->card_name; ?></h3>
                                            <p><span><em><?= $card->last_digits; ?></em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><?= $card->expire; ?></span></p>
                                            <button class="list__top-btn" rel="edit-<?= $card->id; ?>">Edit</button>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>You currently have no cards registered</p>
                            <?php endif; ?>
                            <button class="list__add-btn" id="open-add-card-modal">
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
<?php require APPROOT . '/views/inc/js.php'; ?>
<!-- Put Custom js -->
<script>
    // Card Adding logics

    // Grab Modal wrapper - for toggling display
    const addCardModalWrapper = document.getElementById('add-card-modal-wrapper')
    const editCardModalWrapper = document.getElementById('edit-card-modal-wrapper')

    // Show modal when add button clicked
    const openAddCardBtn = document.getElementById('open-add-card-modal')
    openAddCardBtn.addEventListener('click', () => Event.showModal(addCardModalWrapper))
    const openEditCardBtn = document.querySelectorAll('.list__top-btn[rel*=edit-]')
    openEditCardBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            let card_id = btn.getAttribute('rel').split('-')[1]

            Event.showEditCardModal(editCardModalWrapper, card_id)
        })
    });

    // Hide modal when close button clicked
    const close = document.querySelectorAll('.close')
    close.forEach(close => {
        close.addEventListener('click', () => Event.hideModal())
    });

    // Save data to db through api when save button clicked
    const addCardBtn = document.getElementById('save-card')
    addCardBtn.addEventListener('click', e => {
        Event.addCard(http, addCardModalWrapper)

        e.preventDefault()
    })
    
    // Enable escape key to close modals
    document.onkeydown = function(evt) {
        evt = evt || window.event;
        if (evt.keyCode == 27) {
            close.forEach(close => {
                close.click()
            });
        }
    };
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>