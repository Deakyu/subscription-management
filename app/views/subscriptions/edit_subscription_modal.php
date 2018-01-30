<div class="modal-wrapper" id="edit-subscription-modal-wrapper">
    <div class="modal" id="edit-subscription-modal">
        <div class="modal__header">
            <h2>Edit Subscription</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal__body">
            <form class="form form--modal">
                <input type="hidden" name="user_id" id="edit_user_id" value="<?= $_SESSION['user_id']; ?>">
                <div class="form__group">
                    <label class="form__label" for="subscription_name">Subscription Name </label>
                    <input class="form__input" type="text" name="subscription_name" id="edit_subscription_name">
                    <small class="form__error" id="edit_subscription_name_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label form__label--file" for="logo">
                        Logo 
                    </label>
                    <input class="form__input" type="file" name="logo" id="edit_logo" onchange="previewFileEdit()">
                    <div class="preview-container">
                        <img id="edit_logo-img" src="/images/placeholder_small.png">
                    </div>
                    <small class="form__error" id="edit_logo_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="period">Period </label>
                    <select class="form__input" type="text" name="period" id="edit_period">
                        <option value="0">--Choose period type--</option>
                        <option value="w">Weekly</option>
                        <option value="m">Monthly</option>
                        <option value="y">Yearly</option>
                        <option value="o">Other</option>
                    </select>
                    <small class="form__error" id="edit_period_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="amount">Amount </label>
                    <input class="form__input" type="text" name="amount" id="edit_amount">
                    <small class="form__error" id="edit_amount_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="due">Due Date (mm/dd/yy)</label>
                    <input class="form__input" type="text" name="due" id="edit_due">
                    <small class="form__error" id="edit_due_err"></small>
                </div>
                <div class="form__group">
                    <?php if(! empty($data['cards'])): ?>
                        <label class="form__label" for="card">Card </label>
                        <select class="form__input" type="text" name="card" id="edit_card">
                            <option value="0">--Choose card--</option>
                            <?php foreach($data['cards'] as $card): ?>
                                <option value="<?= $card->id; ?>"><?= $card->card_name; ?> : <?= $card->company; ?> <?= $card->last_digits; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form__error" id="edit_card_err"></small>
                    <?php else: ?>
                        <h3 style="text-align:center;" class="btn-status btn-status--danger"><a href="/cards">You have not registered any card yet <i class="fa fa-exclamation-circle" aria-hidden="true"></i></a></h3>
                    <?php endif; ?>
                </div>
                <input id="update-subscription" class="btn" type="submit" value="Update">
                <input id="delete-subscription" class="btn btn--danger" type="submit" value="Delete">
            </form>
        </div>
    </div>
</div>