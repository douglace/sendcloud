export default class PopupLoader {

    popup: HTMLElement
    loader: HTMLElement

    /**
     * 
     * @param {boolean} can_close 
     */
    start(can_close = true) {
        this.popup = this.createPopup()
        this.loader = this.createLoader()
        this.popup.appendChild(this.loader);
        this.popup.parentElement.addEventListener('click', event => {
            if(can_close) {
                this.stop()
            }
            
        });
        this.popup.addEventListener('click', event => {
            event.stopPropagation()
        });
        return this
    }

    stop() {
        this.loader.remove()
        this.popup.parentElement.remove()
    }

    showLoader() {
        this.loader.classList.remove('is-hidden')
        return this
    }

    hideLoader() {
        this.loader.classList.add('is-hidden')
        return this
    }

    createPopup() {
        let body = document.body
        let overlay = document.createElement('div')
        let box = document.createElement('div')
        overlay.classList.add('sc-overlay')
        box.classList.add('scp-box-container')
        overlay.appendChild(box)
        body.appendChild(overlay)
        return box;
    }
    /**
     * 
     * @param {string} cls 
     * @returns 
     */
    createLoader(cls :string|null = null) {
        let loader = document.createElement('div')
        loader.classList.add('lds-dual-ring')
        if(cls) {
            loader.classList.add(cls)
        }
        return loader
    }
}