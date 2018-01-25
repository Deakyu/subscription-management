<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php //dd($data); ?>
<?php require APPROOT . '/views/inc/add_subscription_modal.php'; ?>

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
                                            <img src="https://media.simplecast.com/podcast/image/1486/1472822603-artwork.jpg">
                                        </div>
                                        <div class="list__title">
                                            <h3><?= $item->name; ?></h3>
                                            <p style="font-weight:bold;text-decoration:underline;">$ <?= $item->amount; ?></p>
                                            <p>Next Due: <?= "{$item->due->month}/{$item->due->day}/{$year}"; ?></p>
                                            <p>Status: 
                                                <button class="btn-status btn-status<?= $item->paid ? '--success' : '--danger'; ?>">
                                                    <?= $item->paid ? "Paid" : "Not Paid"; ?> 
                                                    <i class="fa <?= $item->paid ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>" aria-hidden="true"></i>
                                                </button>
                                            </p>
                                            <button class="list__top-btn" rel="js-payBtn">Pay</button>
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

    function validateDate() {
        const re = /^[0-1]?[0-9]{1}\/[0-3]{1}[0-9]{1}\/[0-9]{2}$/
        const due = document.getElementById('due')
        const dueError = document.getElementById('due_err')
        const saveSubscriptionBtn = document.getElementById('save-subscription')
        due.addEventListener('keyup', e => {
            if(!re.test(due.value)) {
                saveSubscriptionBtn.disabled = true
                dueError.innerHTML = "Please enter valid date"
            } else {
                saveSubscriptionBtn.disabled = false
                dueError.innerHTML = ""
            }
        })
    }

</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>