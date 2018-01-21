class UI {
    constructor() {
        this.menu = document.querySelector('.nav__menu')
        this.dropdownBtn = document.querySelector('.nav__dropdown-btn')
        this.payBtns = document.querySelectorAll('.pay')
        this.inputs = document.querySelectorAll('.form__input')
        this.flash = document.querySelectorAll('.flash')
        this.modal = document.querySelectorAll('.modal-wrapper')
        this.modalContent = document.querySelectorAll('.modal');
        this.closeBtn = document.querySelectorAll('.close')
        this.modalBtn = document.querySelectorAll('[rel=js-modal]')
    }
}