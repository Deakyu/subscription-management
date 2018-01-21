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

    static showModal() {
        const modals = (new UI).modal
        modals.forEach(modal => modal.style.display="block")
    }

    static hideModal() {
        const modals = (new UI).modal
        modals.forEach(modal => modal.style.display="none")
    }

    static addCard(http) {
        let card_name = document.getElementById('card_name').value
        let company = document.getElementById('company').value
        let last_digit = document.getElementById('last_digit').value
        let user_id = document.getElementById('user_id').value

        let data = {
            card_name: card_name,
            company: company,
            last_digit: last_digit,
            user_id: user_id
        }
        http.post('/card/save', data)
            .then(data => {
                // TODO: Handle error from php!
                // Handle Error if exists
                let card_name_err = document.getElementById('card_name_err')
                let company_err = document.getElementById('company_err')
                let last_digit_err = document.getElementById('last_digit_err')

                card_name_err.innerHTML = data.error.card_name
                company_err.innerHTML = data.error.company
                last_digit_err.innerHTML = data.error.last_digit

                // If not, card is added to db, so close modal
                // and give feedback
                // TODO: Flash message on js side
            })
            .catch(err => {
                console.error(err)
            })

    }
}