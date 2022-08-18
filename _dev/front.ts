import "./sass/front.scss"

class AddReturn {

    constructor(public addReturn: HTMLElement) {
        this.addReturn.addEventListener('click', event => this.add())
    }

    add() {
        console.log('add return')
    }
}

window.addEventListener('DOMContentLoaded', () => {
    let addReturn = document.querySelector<HTMLElement>('.sc-returns .add-return');

    if(addReturn) {
       new AddReturn(addReturn)
    }
})