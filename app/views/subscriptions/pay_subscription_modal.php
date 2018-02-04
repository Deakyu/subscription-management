<div class="modal-wrapper" id="pay-subscription-modal-wrapper">
    <div class="modal" id="pay-subscription-modal">
        <div class="modal__header">
            <h2>Pay</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal__body">
            <form class="form form--modal">
                <input type="hidden" name="user_id" id="pay_user_id" value="<?= $_SESSION['user_id']; ?>">
                <div class="form__group">
                    <div class="preview-container">
                        <img id="pay_logo-img" src="/images/placeholder_small.png">
                    </div>
                </div>
                <div class="form__group">
                    <label class="form__label" for="subscription_name">Subscription Name </label>
                    <input class="form__input" type="text" name="subscription_name" id="pay_subscription_name" disabled>
                </div>
                <div class="form__group">
                    <label class="form__label" for="amount">Amount </label>
                    <input class="form__input" type="text" name="amount" id="pay_amount">
                    <small class="form__error" id="pay_amount_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="due">Next Due: (mm/dd/yy)</label>
                    <input class="form__input" type="text" name="due" id="pay_due">
                    <small class="form__error" id="pay_due_err"></small>
                </div>
                <div class="form__group">
                    <?php if(! empty($data['cards'])): ?>
                        <label class="form__label" for="card">Card </label>
                        <select class="form__input" type="text" name="card" id="pay_card">
                            <option value="0">--Choose card--</option>
                            <?php foreach($data['cards'] as $card): ?>
                                <option value="<?= $card->id; ?>"><?= $card->card_name; ?> : <?= $card->company; ?> <?= $card->last_digits; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form__error" id="pay_card_err"></small>
                    <?php else: ?>
                        <h3 style="text-align:center;" class="btn-status btn-status--danger"><a href="/cards">You have not registered any card yet <i class="fa fa-exclamation-circle" aria-hidden="true"></i></a></h3>
                    <?php endif; ?>
                </div>
                <input id="pay-subscription" class="btn" type="submit" value="pay">
            </form>
        </div>
    </div>
</div>