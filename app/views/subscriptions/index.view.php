<?php require APPROOT . '/views/inc/header.php'; ?>

<?php require APPROOT . '/views/subscriptions/add_subscription_modal.php'; ?>
<?php require APPROOT . '/views/subscriptions/edit_subscription_modal.php'; ?>
<?php require APPROOT . '/views/subscriptions/pay_subscription_modal.php'; ?>

<div class="grid">
    <div class="col-3">
        <div class="module module--empty"></div>
    </div>
    <div class="col-6">
        <div class="module">
            <?= flash('login_success'); ?>
            <?= flash('connection_error'); ?>
            <?php foreach($data['subscriptions'] as $period=>$subscription): ?>
                <div class="panel">
                    <div class="panel__heading"><?= ucwords($period); ?> Plans <a class="view-all" href="#">View All &nbsp;<i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a></div>
                    <div class="panel__body">
                        <ul class="list">
                            <?php if(!empty($subscription)): ?>
                                <?php foreach($subscription as $item): ?>
                                    <?php $year = substr($item->due->year, -2); ?>
                                    <li class="list__item">
                                        <div class="list__logo">
                                            <img src="<?= $item->logo; ?>">
                                        </div>
                                        <div class="list__title">
                                            <h3><?= $item->name; ?></h3>
                                            <p style="font-weight:bold;text-decoration:underline;">$ <?= $item->amount; ?></p>
                                            <p>Due: <?= "{$item->due->month}/{$item->due->day}/{$year}"; ?></p>
                                            <!-- TODO: xx days/hours left OR xx days/hours passed -->
                                            <p>Status: 
                                                <button class="btn-status btn-status--success" rel='pay-subscription-<?= $item->id ;?>'>
                                                    Pay
                                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                </button>
                                            </p>
                                            <button class="list__top-btn" rel="edit-<?= $item->id; ?>">Edit</button>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>You currently have no <?= $period; ?> subscriptions</p>
                            <?php endif; ?>
                            <button class="list__add-btn open-add-subscription-modal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
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
    const editSubscriptionModalWrapper = document.getElementById('edit-subscription-modal-wrapper')
    const paySubscriptionModalWrapper = document.getElementById('pay-subscription-modal-wrapper')

    // Show modal when add button clicked
    const openAddSubscriptionBtns = document.querySelectorAll('.open-add-subscription-modal')
    openAddSubscriptionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            Event.showModal(addSubscriptionModalWrapper)
        })
    });
    const openEditSubscriptionBtns = document.querySelectorAll('.list__top-btn[rel*=edit-]')
    openEditSubscriptionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let subscription_id = btn.getAttribute('rel').split('-')[1]

            Event.showEditSubscriptionModal(editSubscriptionModalWrapper , subscription_id)
        })
    });
    const paySubscriptionBtns = document.querySelectorAll('button[rel*=pay-subscription-]')
    paySubscriptionBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            let subscription_id = btn.getAttribute('rel').split('-')[2]

            Event.showPaySubscriptionModal(paySubscriptionModalWrapper, subscription_id)
        })
    });

    // Hide modal when close button clicked
    const close = document.querySelectorAll('.close')
    close.forEach(close => {
        close.addEventListener('click', () => Event.hideModal())
    });

    // Date Validation
    validateDate()

    const saveSubscriptionBtn = document.getElementById('save-subscription')
    // Save subscription to db through api when save button clicked
    saveSubscriptionBtn.addEventListener('click', e => {
        Event.addSubscription(http, addSubscriptionModalWrapper)

        e.preventDefault()
    })

    // When save button clicked, convert date format so that
    // it can be interpreted by PHP


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