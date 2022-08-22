
import './sass/history.scss'

type Returned = {
    reference: string
    button: string
}


const addReturnRow = () => {
    let th = document.createElement('th'),
        trHead = document.querySelector('.js-content-wrapper table thead tr'),
        tbody = document.querySelector('.js-content-wrapper table tbody')
    ;

    if(trHead) {
        trHead.appendChild(th)
    }

    if(tbody) {
        tbody.querySelectorAll('tr').forEach(tr => {
            let td = document.createElement('td'),
                ref = (tr.firstElementChild as HTMLElement).innerText,
                re = getAllReturned().find(a => a.reference == ref)
            ;

            if(re) {
                td.innerHTML = re.button
            }
            td.classList.add('js-return-row')
            tr.appendChild(td)
        })
    }

}

const getAllReturned = ():Returned[] => {
    return toreturns
}

window.addEventListener('DOMContentLoaded', () => {
    addReturnRow()
})