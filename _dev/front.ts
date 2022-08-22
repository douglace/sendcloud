import { dangerToast, successToast } from "./modules/toast"
import { _query } from "./modules/query"
import PopupLoader from "./modules/popup"

import "./sass/front.scss"
import { OrderListItem } from "./types/types"

const getOrderListToReturn = (): OrderListItem[] => {
    return orders_list;
}

const getReturnLink = (): string => {
    return return_link;
}

class AddReturn {

    private popup: PopupLoader
    private wrapperInput: HTMLElement

    constructor(public addReturn: HTMLElement) {
        this.addReturn.addEventListener('click', event => this.add())
        this.popup = new PopupLoader()
    }

    add() {
        this.popup.start().hideLoader().popup.appendChild(
            this.pattern
        )
    }

    get pattern(): HTMLElement {
        let wrapper = document.createElement('div'),
            input = document.createElement('input'),
            button = document.createElement('button')
        ;

        wrapper.classList.add('wrap-add-orders')
        wrapper.appendChild(input)
        wrapper.appendChild(button)

        input.placeholder = "Entrez la reference de la commande"

        button.innerHTML = 'Add';
        button.classList.add('btn')
        button.classList.add('btn-default')

        button.addEventListener('click', event => this.addReturnOrder(input.value))
        this.wrapperInput = wrapper
        return wrapper
    }

    addRowReturn({ref, ret, am, da, ac}: {ref: string, ret: string, am: string, da: string, ac: string }) {
        let tr = document.createElement('tr'),
            reference = document.createElement('td'),
            returnID = document.createElement('td'),
            amount = document.createElement('td'),
            dateAdd = document.createElement('td'),
            action = document.createElement('td')
        ;

        tr.appendChild(reference)
        tr.appendChild(returnID)
        tr.appendChild(amount)
        tr.appendChild(dateAdd)
        tr.appendChild(action)

        reference.innerHTML = ref;
        returnID.innerHTML = ret;
        amount.innerHTML = am;
        dateAdd.innerHTML = da;
        action.innerHTML = ac;

        console.log(ac, action)

        let tbody = document.querySelector('.sc-returns tbody')

        if(tbody) {
            tbody.appendChild(tr)
        }
    }

    async addReturnOrder(reference: string) {
        let orderItem = getOrderListToReturn().find(a => a.reference == reference)

        if(orderItem) {
            this.popup.showLoader()
            this.wrapperInput.classList.add('is-hidden')

            let res = await _query.post(getReturnLink(), new URLSearchParams({
                is_ajax: "1",
                reference: orderItem.reference,
                id_order: orderItem.id_order,
                submitAddReturn: "1"
            }));

            if(res && res.success == true) {
                if(typeof res.return !== "undefined") {
                    this.addRowReturn({
                        ret: res.return.order_return,
                        ref: res.return.reference,
                        ac: res.return.link,
                        da: res.return.date_add,
                        am: res.return.amount,
                    })
                }
                successToast('Votre commande à été ajouter comme retour')
            } else {
                dangerToast(res.msg || 'Impossible d\'ajouter la commande comme retour')
            }

            this.popup.stop()
        } else {
            dangerToast('Cette commande n\'existe pas')
        }
    }
}

window.addEventListener('DOMContentLoaded', () => {
    let addReturn = document.querySelector<HTMLElement>('.sc-returns .add-return');

    if(addReturn) {
       new AddReturn(addReturn)
    }
})