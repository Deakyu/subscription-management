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
                    <label class="form__label" for="subscription_name">Subscription Name </label>
                    <input class="form__input" type="text" name="subscription_name" id="subscription_name">
                    <small class="form__error" id="subscription_name_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label form__label--file" for="logo">
                        Logo 
                    </label>
                    <input class="form__input" type="file" name="logo" id="logo" onchange="previewFile()">
                    <div class="preview-container">
                        <img id="logo-img" src="/images/placeholder_small.png">
                    </div>
                    <small class="form__error" id="logo_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="period">Period </label>
                    <select class="form__input" type="text" name="period" id="period">
                        <option value="0">--Choose period type--</option>
                        <option value="w">Weekly</option>
                        <option value="m">Monthly</option>
                        <option value="y">Yearly</option>
                        <option value="o">Other</option>
                    </select>
                    <small class="form__error" id="period_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="amount">Amount </label>
                    <input class="form__input" type="text" name="amount" id="amount">
                    <small class="form__error" id="amount_err"></small>
                </div>
                <div class="form__group">
                    <label class="form__label" for="due">Due Date (mm/dd/yy)</label>
                    <input class="form__input" type="text" name="due" id="due">
                    <small class="form__error" id="due_err"></small>
                </div>
                <div class="form__group">
                    <?php if(! empty($data['cards'])): ?>
                        <label class="form__label" for="card">Card </label>
                        <select class="form__input" type="text" name="card" id="card">
                            <option value="0">--Choose card--</option>
                            <?php foreach($data['cards'] as $card): ?>
                                <option value="<?= $card->id; ?>"><?= $card->card_name; ?> : <?= $card->company; ?> <?= $card->last_digits; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="form__error" id="card_err"></small>
                    <?php else: ?>
                        <h3 style="text-align:center;" class="btn-status btn-status--danger"><a href="/cards">You have not registered any card yet <i class="fa fa-exclamation-circle" aria-hidden="true"></i></a></h3>
                    <?php endif; ?>
                </div>
                <input id="save-subscription" class="btn" type="submit" value="Add">
            </form>
        </div>
    </div>
</div>