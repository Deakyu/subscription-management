class Event {

    static keepLabelUp(e) {
        if(!e.target.value) {
            e.target.classList.remove("not-empty")
        } else {
            e.target.classList.add("not-empty")
            var lastChildIndex = e.target.parentNode.children.length-1
            if(e.target.parentNode.children[lastChildIndex].className == 'error') {
                e.target.parentNode.children[lastChildIndex].style.display="none"
            }
        }
    }

    static modalKeepLabelUp(formInputs) {
        formInputs.forEach((input, index) => {
            if(!formInputs[index].value) {
                formInputs[index].classList.remove("not-empty")
            } else {
                formInputs[index].classList.add("not-empty")
            }
        });
    }

    static payButtonPressEffect(btn) {
        btn.addEventListener('mousedown', e => {
            btn.classList.add('pay--down')
            e.preventDefault()
        })
        btn.addEventListener('mouseup', e => {
            btn.classList.remove('pay--down')
            e.preventDefault()
        })
        // Fires after mouseup
        btn.addEventListener('click', e => {
            btn.classList.toggle('pay--unpaid')
            if(btn.textContent === 'Pay') {
                btn.textContent = 'Paid'
            } else {
                btn.textContent = 'Pay'
            }
            e.preventDefault()
        })
    }

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

    static showEditModal(modal, card_id) {
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

                let inputs = [card_name, company, last_digit, expire]
                this.modalKeepLabelUp(inputs)

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

        let time = new Date()
        let hours = time.getHours()
        let minutes = time.getMinutes()
        let seconds = time.getSeconds()
        time = [hours, minutes, seconds]

        let data = {
            subscription_name: subscription_name.value,
            period: period.value,
            amount: amount.value,
            due: due.value,
            card_id: card.value,
            user_id: user_id.value,
            time: time,
            timezone: tz
        }
        data.due = data.due.split('/').join('-');

        http.post('/subscription/save', data)
            .then(res => {
                console.log(res)
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
}