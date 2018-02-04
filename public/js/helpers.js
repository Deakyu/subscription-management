function validateDate() {
    const re = /^[0-1]?[0-9]{1}\/[0-3]{1}[0-9]{1}\/[0-9]{2}$/
    const due = document.getElementById('due')
    const editDue = document.getElementById('edit_due')
    const nextDue = document.getElementById('pay_due')
    const dueError = document.getElementById('due_err')
    const editDueError = document.getElementById('edit_due_err')
    const nextDueError = document.getElementById('pay_due_err')
    const saveSubscriptionBtn = document.getElementById('save-subscription')
    const updateSubscriptionBtn = document.getElementById('update-subscription')
    const paySubscriptionBtn = document.getElementById('pay-subscription')
    due.addEventListener('keyup', e => {
        if(!re.test(due.value)) {
            saveSubscriptionBtn.disabled = true
            dueError.innerHTML = "Please enter valid date"
        } else {
            saveSubscriptionBtn.disabled = false
            dueError.innerHTML = ""
        }
    })
    editDue.addEventListener('keyup', e => {
        if(!re.test(editDue.value)) {
            updateSubscriptionBtn.disabled = true
            editDueError.innerHTML = "Please enter valid date"
        } else {
            updateSubscriptionBtn.disabled = false
            editDueError.innerHTML = ""
        }
    })
    nextDue.addEventListener('keyup', e => {
        if(!re.test(nextDue.value)) {
            paySubscriptionBtn.disabled = true
            nextDueError.innerHTML = "Please enter valid date"
        } else {
            paySubscriptionBtn.disabled = false
            nextDueError.innerHTML = ""
        }
    })
}

function previewFile() {
    const preview = document.getElementById('logo-img')
    const file = document.getElementById('logo').files[0]
    const reader = new FileReader()

    reader.onloadend = () => {
        preview.src = reader.result
    }

    if(file) {
        reader.readAsDataURL(file)
    } else {
        preview.src="/images/placeholder_small.png"
    }
}

function previewFileEdit() {
    const preview = document.getElementById('edit_logo-img')
    const file = document.getElementById('edit_logo').files[0]
    const reader = new FileReader()

    reader.onloadend = () => {
        preview.src = reader.result
    }

    if(file) {
        reader.readAsDataURL(file)
    } else {
        preview.src="/images/placeholder_small.png"
    }
}