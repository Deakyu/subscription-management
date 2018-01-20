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
}