import { ToastType } from '../types/types'

export default class Toast {

    toast: HTMLElement
    toast_text: HTMLElement

    private type: ToastType
    private text: string
    private close_after: number

    constructor(type: ToastType, text: string, close_after: number = 5000) {
        this.toast = document.createElement('div'),
        this.toast_text = document.createElement('p')
        this.type = type
        this.text = text
        this.close_after = close_after
    }

    init() {
        this.toast.classList.add('wishlist-toast')
        this.toast.classList.add(this.type)
        this.toast.style.zIndex = "1000000";
        this.toast_text.classList.add('wishlist-toast-text')
        this.toast_text.innerText = this.text
        this.toast.appendChild(this.toast_text)

        document.body.appendChild(this.toast)
        this.toast.classList.add('isActive')
        console.log(this.toast)
        setTimeout(() => this.toast.classList.remove('isActive'), this.close_after)
        setTimeout(() => this.toast.remove(), (this.close_after + 2000))
    }
}

const curryToast =  (a: ToastType) => (b: string) => (new Toast(a, b)).init()

export const dangerToast = curryToast('error')
export const successToast = curryToast('success')