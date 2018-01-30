class Event {

    static showFlash(ui) {
        var flash = ui.flash
        flash.forEach(el => {
            el.classList.add('active')
        });
        setTimeout(() => {
            var flash = ui.flash
            flash.forEach(el => {
                el.classList.remove('active')
            });
        }, 5000);
    }

    static showModal(modal) {
        modal.style.display="block"
    }

    static showEditCardModal(modal, card_id) {
        modal.style.display="block"

        let card_name = document.getElementById('edit_card_name')
        let company = document.getElementById('edit_company')
        let last_digit = document.getElementById('edit_last_digit')
        let expire = document.getElementById('edit_expire')
        let user_id = document.getElementById('edit_user_id')
        let updateBtn = document.getElementById('update-card')
        let deleteBtn = document.getElementById('delete-card')

        http.get(`/card/${card_id}`)
            .then(res => {
                card_name.value = res[0].card_name
                company.value = res[0].company
                last_digit.value = res[0].last_digits
                expire.value = res[0].expire

                deleteBtn.addEventListener('click', e => {
                    let data = {id: card_id}

                    http.post('/card/delete', data)
                        .then(res => {
                            window.location.reload()
                        })
                        .catch(err => console.log(err))

                    e.preventDefault()
                })

                updateBtn.addEventListener('click', e => {
                    let data = {
                        id: card_id,
                        card_name: card_name.value,
                        user_id: user_id.value,
                        company: company.value,
                        last_digit: last_digit.value,
                        expire: expire.value,
                    }

                    http.post(`/card/update`, data)
                        .then(res => {
                            if(!res.errorExists) {
                                // Card is added successfully
                                    window.location.reload()
                            } else {
                                // Handle Error if exists
                                document.getElementById('edit_card_name_err').innerHTML = res.error.card_name
                                document.getElementById('edit_company_err').innerHTML = res.error.company
                                document.getElementById('edit_last_digit_err').innerHTML = res.error.last_digit
                                document.getElementById('edit_expire_err').innerHTML = res.error.expire
                            }
                        })
                        .catch(err => console.log(err))

                    e.preventDefault()
                })
            })
            .catch(err => console.log(err))
    }

    static hideModal() {
        document.querySelectorAll('.modal-wrapper').forEach(modal => {
            modal.style.display="none"
        })
    }

    static addCard(http, modal) {
        let card_name = document.getElementById('card_name')
        let company = document.getElementById('company')
        let last_digit = document.getElementById('last_digit')
        let expire = document.getElementById('expire')
        let user_id = document.getElementById('user_id')

        let data = {
            card_name: card_name.value,
            company: company.value,
            last_digit: last_digit.value,
            expire: expire.value,
            user_id: user_id.value
        }
        http.post('/card/save', data)
            .then(res => {
                console.log(res)
                if(!res.errorExists) {
                    // Card is added successfully
                        window.location.reload()
                } else {
                    // Handle Error if exists
                    document.getElementById('card_name_err').innerHTML = res.error.card_name
                    document.getElementById('company_err').innerHTML = res.error.company
                    document.getElementById('last_digit_err').innerHTML = res.error.last_digit
                    document.getElementById('expire_err').innerHTML = res.error.expire
                }

            })
            .catch(err => {
                console.error(err)
            })
    }

    static addSubscription(http, modal) {
        let subscription_name = document.getElementById('subscription_name')
        let period = document.getElementById('period')
        let amount = document.getElementById('amount')
        let due = document.getElementById('due')
        let card = document.getElementById('card')
        let user_id = document.getElementById('user_id')
        let logo = document.getElementById('logo').files[0]

        let time = new Date()
        let hours = time.getHours()
        let minutes = time.getMinutes()
        let seconds = time.getSeconds()
        time = [hours, minutes, seconds]

        let data = new FormData()
        data.append('subscription_name', subscription_name.value)
        data.append('period', period.value)
        data.append('amount', amount.value)
        data.append('due', due.value.split('/').join('-'))
        data.append('card_id', card.value)
        data.append('user_id', user_id.value)
        data.append('time', time)
        data.append('timezone', tz)
        data.append('logo', logo)

        http.postWithFile('/subscription/save', data)
            .then(res => {
                if(!res.errorExists) {
                    window.location.reload()
                } else {
                    // Handle Error if exists
                    document.getElementById('subscription_name_err').innerHTML = res.error.subscription_name
                    document.getElementById('amount_err').innerHTML = res.error.amount
                    document.getElementById('period_err').innerHTML = res.error.period
                    document.getElementById('due_err').innerHTML = res.error.due
                    document.getElementById('card_err').innerHTML = res.error.card
                }
            })
            .catch(err => console.log(err))

    }

    static showEditSubscriptionModal(modal, subscription_id) {
        modal.style.display="block"

        let subscription_name = document.getElementById('edit_subscription_name')
        let logo_preview = document.getElementById('edit_logo-img')
        let logo = document.getElementById('edit_logo')
        let period = document.getElementById('edit_period')
        let amount = document.getElementById('edit_amount')
        let due = document.getElementById('edit_due')
        let card = document.getElementById('edit_card')
        let user_id = document.getElementById('edit_user_id')

        let updateBtn = document.getElementById('update-subscription')
        let deleteBtn = document.getElementById('delete-subscription')

        http.get(`/subscription/${subscription_id}`)
            .then(res => {
                subscription_name.value = res[0].name
                period.value = res[0].period
                amount.value = res[0].amount
                due.value = res[0].due.split('-').join('/')
                card.value = res[0].card_id
                logo_preview.setAttribute('src', res[0].logo)

                deleteBtn.addEventListener('click', e => {
                    let data = {id: subscription_id}

                    http.post('/subscription/delete', data)
                        .then(res => {
                            window.location.reload()
                        })
                        .catch(err => console.log(err))

                    e.preventDefault()
                })

                updateBtn.addEventListener('click', e => {
                    let time = new Date()
                    let hours = time.getHours()
                    let minutes = time.getMinutes()
                    let seconds = time.getSeconds()
                    time = [hours, minutes, seconds]

                    let data = new FormData()
                    data.append('id', subscription_id)
                    data.append('name', subscription_name.value)
                    data.append('period', period.value)
                    data.append('amount', amount.value)
                    data.append('due', due.value.split('/').join('-'))
                    data.append('card_id', card.value)
                    data.append('user_id', user_id.value)
                    data.append('time', time)
                    data.append('timezone', tz)
                    data.append('logo', logo.files[0])

                    http.postWithFile(`/subscription/update`, data)
                        .then(res => {
                            if(!res.errorExists) {
                                // Subscription is added successfully
                                    window.location.reload()
                            } else {
                                // Handle Error if exists
                                document.getElementById('edit_subscription_name_err').innerHTML = res.error.subscription_name
                                document.getElementById('edit_period_err').innerHTML = res.error.period
                                document.getElementById('edit_amount_err').innerHTML = res.error.amount
                                document.getElementById('edit_due_err').innerHTML = res.error.due
                                document.getElementById('edit_card_err').innerHTML = res.error.card
                                document.getElementById('edit_logo_err').innerHTML = res.error.logo
                            }
                        })
                        .catch(err => console.log(err))

                    e.preventDefault()
                })
            })
            .catch(err => console.log(err))
    }
}