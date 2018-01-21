<?php require APPROOT . '/views/inc/header.php'; ?>

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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn" rel="js-addWeekly-modal">
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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn" rel="js-addMonthly-modal">
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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
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
                                    <p>Last Paid: <strike>12/18/17</strike></p>
                                    <button class="list__top-btn" rel="js-payBtn">Pay</button>
                                </div>
                            </li>
                            <button class="list__add-btn" rel="js-addYearly-modal">
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