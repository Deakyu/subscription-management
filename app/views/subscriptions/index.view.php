<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="modal-wrapper" id="add-subscription-modal-wrapper">
        <div class="modal" id="add-subscription-modal">
            <div class="modal__header">
                <h2>Add a Subscription</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal__body">
                <form class="form form--modal">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id']; ?>">
                    <div class="form__group">
                        <input class="form__input" type="text" name="subscription_name" id="subscription_name">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="subscription_name">Subscription Name </label>
                        <small class="form__error" id="subscription_name_err"></small>
                    </div>
                    <div class="form__group">
                        <select class="form__input" type="text" name="period" id="period">
                            <option value="0">--Choose period type--</option>
                            <option value="w">Weekly</option>
                            <option value="m">Monthly</option>
                            <option value="y">Yearly</option>
                            <option value="o">Other</option>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="period">Period </label>
                        <small class="form__error" id="period_err"></small>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="number" name="amount" id="amount">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="amount">Amount </label>
                        <small class="form__error" id="amount_err"></small>
                    </div>
                    <div class="form__group">
                        <input class="form__input" type="text" name="due" id="due">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="due">Due Date (mm-dd)</label>
                        <small class="form__error" id="due_err"></small>
                    </div>
                    <div class="form__group">
                        <select class="form__input" type="text" name="card" id="card">
                            <option value="0">--Choose card--</option>
                            <?php foreach($data['cards'] as $card): ?>
                                <option value="<?= $card->id; ?>"><?= $card->card_name; ?> : <?= $card->company; ?> <?= $card->last_digits; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label class="form__label" for="card">Card </label>
                        <small class="form__error" id="card_err"></small>
                    </div>
                    <input id="save-subscription" class="btn" type="submit" value="Add">
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
                <?= flash('login_success'); ?>
                <?= flash('connection_error'); ?>
                <div class="panel">
                    <div class="panel__heading">Weekly Plans <a class="view-all" href="#">View All &nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></div>
                    <div class="panel__body">
                        <ul class="list">
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--paid">Paid <i class="fa fa-check-circle" aria-hidden="true"></i></button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--not-paid">Not Paid <i class="fa fa-exclamation-circle" aria-hidden="true"></i></button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn open-add-subscription-modal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel__heading">Monthly Plans <a class="view-all" href="#">View All &nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></div>
                    <div class="panel__body">
                        <ul class="list">
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--paid">Paid</button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--paid">Paid</button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn open-add-subscription-modal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </ul>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel__heading">Yearly Plans <a class="view-all" href="#">View All &nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></div>
                    <div class="panel__body">
                        <ul class="list">
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--paid">Paid</button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <li class="list__item">
                                <div class="list__logo">
                                    <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                </div>
                                <div class="list__title">
                                    <h3>Laracasts</h3>
                                    <p style="font-weight:bold;text-decoration:underline;">$9.70</p>
                                    <p>Due: 1/18/18</p>
                                    <p>Status: <button class="btn-status btn-status--paid">Paid</button></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn open-add-subscription-modal">
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
    // Subscription Adding logics

    // Grab Modal wrapper for toggling
    const addSubscriptionModalWrapper = document.getElementById('add-subscription-modal-wrapper')

    // Show modal when add button clicked
    const openAddSubscriptionBtns = document.querySelectorAll('.open-add-subscription-modal')
    openAddSubscriptionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            Event.showModal(addSubscriptionModalWrapper)
        })
    });

    // Hide modal when close button clicked
    const close = document.querySelectorAll('.close')
    close.forEach(close => {
        close.addEventListener('click', () => Event.hideModal())
    });

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>