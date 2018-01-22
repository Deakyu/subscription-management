// Init UI
const ui = new UI

// Init HTTP
const http = new easyHTTP

// Move up the label when input is not empty
var formInputs = ui.inputs
formInputs.forEach(input => input.addEventListener("keyup", Event.keepLabelUp))

window.onload = () => {
    var formInputs = ui.inputs
    formInputs.forEach((input, index) => {
        if(!formInputs[index].value) {
            formInputs[index].classList.remove("not-empty")
        } else {
            formInputs[index].classList.add("not-empty")
        }
    });

    // Show flash animated, if exists
    Event.showFlash(ui)
}

// Navbar dropdown
const menu = ui.menu
const dropdownBtn = ui.dropdownBtn

// Show menu when hamburger is clicked
dropdownBtn.addEventListener('click', e => {
    menu.classList.toggle('show-menu')
    e.preventDefault();
})

// Mousedown effect for button
const payBtn = ui.payBtns
payBtn.forEach(btn => Event.payButtonPressEffect(btn))
