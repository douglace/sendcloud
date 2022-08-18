import "./module.css"
import "./header.scss"
import { great } from "./hello"

window.addEventListener('DOMContentLoaded', () => {
    const myIcon = new Image()

    let ct = document.querySelector('#sendcloud-container')
    ct.appendChild(myIcon)

    myIcon.addEventListener('click', () => great())
})