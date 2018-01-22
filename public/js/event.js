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
                        // Add the card to DOM
                        const li = document.createElement('li')
                        li.className = 'list__item'
                        li.innerHTML = `
                        <div class="list__logo">
                            <img src="${res.data.company}">
                            </div>
                            <div class="list__title">
                            <h3>${res.data.card_name}</h3>
                                <p><span><em>${res.data.last_digit}</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>${res.data.expire}</span></p>
                                <button class="list__top-btn" rel="js-payBtn">Edit</button>
                        </div>
                        `
                        document.querySelector('ul.list').appendChild(li)
                        // Empty Modal Inputs
                        card_name.value = ""
                        company.value = ""
                        last_digit.value = ""
                        expire.value = ""

                        // Close Modal
                        this.hideModal()
                        
                        // Show Flash Message

                } else {
                    // Handle Error if exists
                    let card_name_err = document.getElementById('card_name_err')
                    let company_err = document.getElementById('company_err')
                    let last_digit_err = document.getElementById('last_digit_err')
                    let expire_err = document.getElementById('expire_err')
    
                    card_name_err.innerHTML = res.error.card_name
                    company_err.innerHTML = res.error.company
                    last_digit_err.innerHTML = res.error.last_digit
                    expire_err.innerHTML = res.error.expire
                }

            })
            .catch(err => {
                console.error(err)
            })
    }
}