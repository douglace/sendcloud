/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./_dev/modules/popup.ts":
/*!*******************************!*\
  !*** ./_dev/modules/popup.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ PopupLoader)
/* harmony export */ });
class PopupLoader {
  start(can_close = true) {
    this.popup = this.createPopup();
    this.loader = this.createLoader();
    this.popup.appendChild(this.loader);
    this.popup.parentElement.addEventListener("click", (event) => {
      if (can_close) {
        this.stop();
      }
    });
    this.popup.addEventListener("click", (event) => {
      event.stopPropagation();
    });
    return this;
  }
  stop() {
    this.loader.remove();
    this.popup.parentElement.remove();
  }
  showLoader() {
    this.loader.classList.remove("is-hidden");
    return this;
  }
  hideLoader() {
    this.loader.classList.add("is-hidden");
    return this;
  }
  createPopup() {
    let body = document.body;
    let overlay = document.createElement("div");
    let box = document.createElement("div");
    overlay.classList.add("sc-overlay");
    box.classList.add("scp-box-container");
    overlay.appendChild(box);
    body.appendChild(overlay);
    return box;
  }
  createLoader(cls = null) {
    let loader = document.createElement("div");
    loader.classList.add("lds-dual-ring");
    if (cls) {
      loader.classList.add(cls);
    }
    return loader;
  }
}


/***/ }),

/***/ "./_dev/modules/query.ts":
/*!*******************************!*\
  !*** ./_dev/modules/query.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "_query": () => (/* binding */ _query)
/* harmony export */ });
var __defProp = Object.defineProperty;
var __getOwnPropSymbols = Object.getOwnPropertySymbols;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __propIsEnum = Object.prototype.propertyIsEnumerable;
var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
var __spreadValues = (a, b) => {
  for (var prop in b || (b = {}))
    if (__hasOwnProp.call(b, prop))
      __defNormalProp(a, prop, b[prop]);
  if (__getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(b)) {
      if (__propIsEnum.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    }
  return a;
};
var __async = (__this, __arguments, generator) => {
  return new Promise((resolve, reject) => {
    var fulfilled = (value) => {
      try {
        step(generator.next(value));
      } catch (e) {
        reject(e);
      }
    };
    var rejected = (value) => {
      try {
        step(generator.throw(value));
      } catch (e) {
        reject(e);
      }
    };
    var step = (x) => x.done ? resolve(x.value) : Promise.resolve(x.value).then(fulfilled, rejected);
    step((generator = generator.apply(__this, __arguments)).next());
  });
};
const _query = {
  exec: function(_0) {
    return __async(this, arguments, function* (url, data = null, params = {}) {
      params = __spreadValues(__spreadValues({}, {
        method: "GET",
        headers: {
          "Accept": "application/json, text/javascript, */*; q=0.01",
          "X-Requested-With": "XMLHttpRequest"
        }
      }), params);
      if (data) {
        params = __spreadValues(__spreadValues({}, params), { body: data });
      }
      const response = yield fetch(url, params);
      return response.json();
    });
  },
  get: function(_0) {
    return __async(this, arguments, function* (url, params = {}) {
      return this.exec(url, null, params);
    });
  },
  post: function(_0) {
    return __async(this, arguments, function* (url, data = null, params = {}) {
      params = __spreadValues(__spreadValues({}, params), { method: "POST" });
      return this.exec(url, data, params);
    });
  }
};


/***/ }),

/***/ "./_dev/modules/toast.ts":
/*!*******************************!*\
  !*** ./_dev/modules/toast.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "dangerToast": () => (/* binding */ dangerToast),
/* harmony export */   "default": () => (/* binding */ Toast),
/* harmony export */   "successToast": () => (/* binding */ successToast)
/* harmony export */ });
class Toast {
  constructor(type, text, close_after = 5e3) {
    this.toast = document.createElement("div"), this.toast_text = document.createElement("p");
    this.type = type;
    this.text = text;
    this.close_after = close_after;
  }
  init() {
    this.toast.classList.add("wishlist-toast");
    this.toast.classList.add(this.type);
    this.toast.style.zIndex = "1000000";
    this.toast_text.classList.add("wishlist-toast-text");
    this.toast_text.innerText = this.text;
    this.toast.appendChild(this.toast_text);
    document.body.appendChild(this.toast);
    this.toast.classList.add("isActive");
    console.log(this.toast);
    setTimeout(() => this.toast.classList.remove("isActive"), this.close_after);
    setTimeout(() => this.toast.remove(), this.close_after + 2e3);
  }
}
const curryToast = (a) => (b) => new Toast(a, b).init();
const dangerToast = curryToast("error");
const successToast = curryToast("success");


/***/ }),

/***/ "./_dev/sass/front.scss":
/*!******************************!*\
  !*** ./_dev/sass/front.scss ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***********************!*\
  !*** ./_dev/front.ts ***!
  \***********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _modules_toast__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/toast */ "./_dev/modules/toast.ts");
/* harmony import */ var _modules_query__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/query */ "./_dev/modules/query.ts");
/* harmony import */ var _modules_popup__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./modules/popup */ "./_dev/modules/popup.ts");
/* harmony import */ var _sass_front_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./sass/front.scss */ "./_dev/sass/front.scss");
var __async = (__this, __arguments, generator) => {
  return new Promise((resolve, reject) => {
    var fulfilled = (value) => {
      try {
        step(generator.next(value));
      } catch (e) {
        reject(e);
      }
    };
    var rejected = (value) => {
      try {
        step(generator.throw(value));
      } catch (e) {
        reject(e);
      }
    };
    var step = (x) => x.done ? resolve(x.value) : Promise.resolve(x.value).then(fulfilled, rejected);
    step((generator = generator.apply(__this, __arguments)).next());
  });
};




const getOrderListToReturn = () => {
  return orders_list;
};
const getReturnLink = () => {
  return return_link;
};
class AddReturn {
  constructor(addReturn) {
    this.addReturn = addReturn;
    this.addReturn.addEventListener("click", (event) => this.add());
    this.popup = new _modules_popup__WEBPACK_IMPORTED_MODULE_2__["default"]();
  }
  add() {
    this.popup.start().hideLoader().popup.appendChild(
      this.pattern
    );
  }
  get pattern() {
    let wrapper = document.createElement("div"), input = document.createElement("input"), button = document.createElement("button");
    wrapper.classList.add("wrap-add-orders");
    wrapper.appendChild(input);
    wrapper.appendChild(button);
    input.placeholder = "Entrez la reference de la commande";
    button.innerHTML = "Add";
    button.classList.add("btn");
    button.classList.add("btn-default");
    button.addEventListener("click", (event) => this.addReturnOrder(input.value));
    this.wrapperInput = wrapper;
    return wrapper;
  }
  addRowReturn({ ref, ret, am, da, ac }) {
    let tr = document.createElement("tr"), reference = document.createElement("td"), returnID = document.createElement("td"), amount = document.createElement("td"), dateAdd = document.createElement("td"), action = document.createElement("td");
    tr.appendChild(reference);
    tr.appendChild(returnID);
    tr.appendChild(amount);
    tr.appendChild(dateAdd);
    tr.appendChild(action);
    reference.innerHTML = ref;
    returnID.innerHTML = ret;
    amount.innerHTML = am;
    dateAdd.innerHTML = da;
    action.innerHTML = ac;
    console.log(ac, action);
    let tbody = document.querySelector(".sc-returns tbody");
    if (tbody) {
      tbody.appendChild(tr);
    }
  }
  addReturnOrder(reference) {
    return __async(this, null, function* () {
      let orderItem = getOrderListToReturn().find((a) => a.reference == reference);
      if (orderItem) {
        this.popup.showLoader();
        this.wrapperInput.classList.add("is-hidden");
        let res = yield _modules_query__WEBPACK_IMPORTED_MODULE_1__._query.post(getReturnLink(), new URLSearchParams({
          is_ajax: "1",
          reference: orderItem.reference,
          id_order: orderItem.id_order,
          submitAddReturn: "1"
        }));
        if (res && res.success == true) {
          if (typeof res.return !== "undefined") {
            this.addRowReturn({
              ret: res.return.order_return,
              ref: res.return.reference,
              ac: res.return.link,
              da: res.return.date_add,
              am: res.return.amount
            });
          }
          (0,_modules_toast__WEBPACK_IMPORTED_MODULE_0__.successToast)("Votre commande \xE0 \xE9t\xE9 ajouter comme retour");
        } else {
          (0,_modules_toast__WEBPACK_IMPORTED_MODULE_0__.dangerToast)(res.msg || "Impossible d'ajouter la commande comme retour");
        }
        this.popup.stop();
      } else {
        (0,_modules_toast__WEBPACK_IMPORTED_MODULE_0__.dangerToast)("Cette commande n'existe pas");
      }
    });
  }
}
window.addEventListener("DOMContentLoaded", () => {
  let addReturn = document.querySelector(".sc-returns .add-return");
  if (addReturn) {
    new AddReturn(addReturn);
  }
});

})();

/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QixvQkFBb0IsTUFBTTtBQUM5QyxNQUFJLFlBQVksU0FBUyxjQUEyQix5QkFBeUI7QUFFN0UsTUFBRyxXQUFXO0FBQ1gsUUFBSSxVQUFVLFNBQVM7QUFBQSxFQUMxQjtBQUNKLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly9zZW5kY2xvdWQvLi9fZGV2L21vZHVsZXMvcG9wdXAudHMiLCJ3ZWJwYWNrOi8vc2VuZGNsb3VkLy4vX2Rldi9tb2R1bGVzL3F1ZXJ5LnRzIiwid2VicGFjazovL3NlbmRjbG91ZC8uL19kZXYvbW9kdWxlcy90b2FzdC50cyIsIndlYnBhY2s6Ly9zZW5kY2xvdWQvLi9fZGV2L3Nhc3MvZnJvbnQuc2Nzcz9jZjM5Iiwid2VicGFjazovL3NlbmRjbG91ZC93ZWJwYWNrL2Jvb3RzdHJhcCIsIndlYnBhY2s6Ly9zZW5kY2xvdWQvd2VicGFjay9ydW50aW1lL2RlZmluZSBwcm9wZXJ0eSBnZXR0ZXJzIiwid2VicGFjazovL3NlbmRjbG91ZC93ZWJwYWNrL3J1bnRpbWUvaGFzT3duUHJvcGVydHkgc2hvcnRoYW5kIiwid2VicGFjazovL3NlbmRjbG91ZC93ZWJwYWNrL3J1bnRpbWUvbWFrZSBuYW1lc3BhY2Ugb2JqZWN0Iiwid2VicGFjazovL3NlbmRjbG91ZC8uL19kZXYvZnJvbnQudHMiXSwic291cmNlc0NvbnRlbnQiOlsiZXhwb3J0IGRlZmF1bHQgY2xhc3MgUG9wdXBMb2FkZXIge1xuXG4gICAgcG9wdXA6IEhUTUxFbGVtZW50XG4gICAgbG9hZGVyOiBIVE1MRWxlbWVudFxuXG4gICAgLyoqXG4gICAgICogXG4gICAgICogQHBhcmFtIHtib29sZWFufSBjYW5fY2xvc2UgXG4gICAgICovXG4gICAgc3RhcnQoY2FuX2Nsb3NlID0gdHJ1ZSkge1xuICAgICAgICB0aGlzLnBvcHVwID0gdGhpcy5jcmVhdGVQb3B1cCgpXG4gICAgICAgIHRoaXMubG9hZGVyID0gdGhpcy5jcmVhdGVMb2FkZXIoKVxuICAgICAgICB0aGlzLnBvcHVwLmFwcGVuZENoaWxkKHRoaXMubG9hZGVyKTtcbiAgICAgICAgdGhpcy5wb3B1cC5wYXJlbnRFbGVtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4ge1xuICAgICAgICAgICAgaWYoY2FuX2Nsb3NlKSB7XG4gICAgICAgICAgICAgICAgdGhpcy5zdG9wKClcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIFxuICAgICAgICB9KTtcbiAgICAgICAgdGhpcy5wb3B1cC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHtcbiAgICAgICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpXG4gICAgICAgIH0pO1xuICAgICAgICByZXR1cm4gdGhpc1xuICAgIH1cblxuICAgIHN0b3AoKSB7XG4gICAgICAgIHRoaXMubG9hZGVyLnJlbW92ZSgpXG4gICAgICAgIHRoaXMucG9wdXAucGFyZW50RWxlbWVudC5yZW1vdmUoKVxuICAgIH1cblxuICAgIHNob3dMb2FkZXIoKSB7XG4gICAgICAgIHRoaXMubG9hZGVyLmNsYXNzTGlzdC5yZW1vdmUoJ2lzLWhpZGRlbicpXG4gICAgICAgIHJldHVybiB0aGlzXG4gICAgfVxuXG4gICAgaGlkZUxvYWRlcigpIHtcbiAgICAgICAgdGhpcy5sb2FkZXIuY2xhc3NMaXN0LmFkZCgnaXMtaGlkZGVuJylcbiAgICAgICAgcmV0dXJuIHRoaXNcbiAgICB9XG5cbiAgICBjcmVhdGVQb3B1cCgpIHtcbiAgICAgICAgbGV0IGJvZHkgPSBkb2N1bWVudC5ib2R5XG4gICAgICAgIGxldCBvdmVybGF5ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2JylcbiAgICAgICAgbGV0IGJveCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2RpdicpXG4gICAgICAgIG92ZXJsYXkuY2xhc3NMaXN0LmFkZCgnc2Mtb3ZlcmxheScpXG4gICAgICAgIGJveC5jbGFzc0xpc3QuYWRkKCdzY3AtYm94LWNvbnRhaW5lcicpXG4gICAgICAgIG92ZXJsYXkuYXBwZW5kQ2hpbGQoYm94KVxuICAgICAgICBib2R5LmFwcGVuZENoaWxkKG92ZXJsYXkpXG4gICAgICAgIHJldHVybiBib3g7XG4gICAgfVxuICAgIC8qKlxuICAgICAqIFxuICAgICAqIEBwYXJhbSB7c3RyaW5nfSBjbHMgXG4gICAgICogQHJldHVybnMgXG4gICAgICovXG4gICAgY3JlYXRlTG9hZGVyKGNscyA6c3RyaW5nfG51bGwgPSBudWxsKSB7XG4gICAgICAgIGxldCBsb2FkZXIgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKVxuICAgICAgICBsb2FkZXIuY2xhc3NMaXN0LmFkZCgnbGRzLWR1YWwtcmluZycpXG4gICAgICAgIGlmKGNscykge1xuICAgICAgICAgICAgbG9hZGVyLmNsYXNzTGlzdC5hZGQoY2xzKVxuICAgICAgICB9XG4gICAgICAgIHJldHVybiBsb2FkZXJcbiAgICB9XG59IiwiZXhwb3J0ICBjb25zdCBfcXVlcnkgPSB7XG4gICAgZXhlYzogYXN5bmMgZnVuY3Rpb24odXJsOiBzdHJpbmcsIGRhdGE6YW55ID0gbnVsbCwgcGFyYW1zID0ge30pIHtcbiAgICAgICAgcGFyYW1zID0ge1xuICAgICAgICAgICAgLi4uIHtcbiAgICAgICAgICAgICAgICBtZXRob2Q6ICdHRVQnLFxuICAgICAgICAgICAgICAgIGhlYWRlcnM6IHtcbiAgICAgICAgICAgICAgICAgICAgXCJBY2NlcHRcIjogXCJhcHBsaWNhdGlvbi9qc29uLCB0ZXh0L2phdmFzY3JpcHQsICovKjsgcT0wLjAxXCIsXG4gICAgICAgICAgICAgICAgICAgIFwiWC1SZXF1ZXN0ZWQtV2l0aFwiOiBcIlhNTEh0dHBSZXF1ZXN0XCJcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICAgICAgLi4ucGFyYW1zXG4gICAgICAgIH1cbiAgICAgICAgaWYgKGRhdGEpIHtcbiAgICAgICAgICAgIHBhcmFtcyA9IHtcbiAgICAgICAgICAgICAgICAuLi5wYXJhbXMsXG4gICAgICAgICAgICAgICAgLi4uIHsgYm9keTogZGF0YSB9XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cblxuICAgICAgICBjb25zdCByZXNwb25zZSA9IGF3YWl0IGZldGNoKHVybCwgcGFyYW1zKTtcbiAgICAgICAgcmV0dXJuIHJlc3BvbnNlLmpzb24oKTtcbiAgICB9LFxuICAgIGdldDogYXN5bmMgZnVuY3Rpb24odXJsOiBzdHJpbmcsIHBhcmFtcyA9IHt9KSB7XG4gICAgICAgIHJldHVybiB0aGlzLmV4ZWModXJsLCBudWxsLCBwYXJhbXMpXG4gICAgfSxcbiAgICBwb3N0OiBhc3luYyBmdW5jdGlvbih1cmw6IHN0cmluZywgZGF0YTphbnkgPSBudWxsLCBwYXJhbXMgPSB7fSkge1xuICAgICAgICBwYXJhbXMgPSB7Li4ucGFyYW1zLCAuLi4geyBtZXRob2Q6IFwiUE9TVFwiIH0gfVxuICAgICAgICByZXR1cm4gdGhpcy5leGVjKHVybCwgZGF0YSwgcGFyYW1zKVxuICAgIH0sXG59IiwiaW1wb3J0IHsgVG9hc3RUeXBlIH0gZnJvbSAnLi4vdHlwZXMvdHlwZXMnXG5cbmV4cG9ydCBkZWZhdWx0IGNsYXNzIFRvYXN0IHtcblxuICAgIHRvYXN0OiBIVE1MRWxlbWVudFxuICAgIHRvYXN0X3RleHQ6IEhUTUxFbGVtZW50XG5cbiAgICBwcml2YXRlIHR5cGU6IFRvYXN0VHlwZVxuICAgIHByaXZhdGUgdGV4dDogc3RyaW5nXG4gICAgcHJpdmF0ZSBjbG9zZV9hZnRlcjogbnVtYmVyXG5cbiAgICBjb25zdHJ1Y3Rvcih0eXBlOiBUb2FzdFR5cGUsIHRleHQ6IHN0cmluZywgY2xvc2VfYWZ0ZXI6IG51bWJlciA9IDUwMDApIHtcbiAgICAgICAgdGhpcy50b2FzdCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2RpdicpLFxuICAgICAgICB0aGlzLnRvYXN0X3RleHQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdwJylcbiAgICAgICAgdGhpcy50eXBlID0gdHlwZVxuICAgICAgICB0aGlzLnRleHQgPSB0ZXh0XG4gICAgICAgIHRoaXMuY2xvc2VfYWZ0ZXIgPSBjbG9zZV9hZnRlclxuICAgIH1cblxuICAgIGluaXQoKSB7XG4gICAgICAgIHRoaXMudG9hc3QuY2xhc3NMaXN0LmFkZCgnd2lzaGxpc3QtdG9hc3QnKVxuICAgICAgICB0aGlzLnRvYXN0LmNsYXNzTGlzdC5hZGQodGhpcy50eXBlKVxuICAgICAgICB0aGlzLnRvYXN0LnN0eWxlLnpJbmRleCA9IFwiMTAwMDAwMFwiO1xuICAgICAgICB0aGlzLnRvYXN0X3RleHQuY2xhc3NMaXN0LmFkZCgnd2lzaGxpc3QtdG9hc3QtdGV4dCcpXG4gICAgICAgIHRoaXMudG9hc3RfdGV4dC5pbm5lclRleHQgPSB0aGlzLnRleHRcbiAgICAgICAgdGhpcy50b2FzdC5hcHBlbmRDaGlsZCh0aGlzLnRvYXN0X3RleHQpXG5cbiAgICAgICAgZG9jdW1lbnQuYm9keS5hcHBlbmRDaGlsZCh0aGlzLnRvYXN0KVxuICAgICAgICB0aGlzLnRvYXN0LmNsYXNzTGlzdC5hZGQoJ2lzQWN0aXZlJylcbiAgICAgICAgY29uc29sZS5sb2codGhpcy50b2FzdClcbiAgICAgICAgc2V0VGltZW91dCgoKSA9PiB0aGlzLnRvYXN0LmNsYXNzTGlzdC5yZW1vdmUoJ2lzQWN0aXZlJyksIHRoaXMuY2xvc2VfYWZ0ZXIpXG4gICAgICAgIHNldFRpbWVvdXQoKCkgPT4gdGhpcy50b2FzdC5yZW1vdmUoKSwgKHRoaXMuY2xvc2VfYWZ0ZXIgKyAyMDAwKSlcbiAgICB9XG59XG5cbmNvbnN0IGN1cnJ5VG9hc3QgPSAgKGE6IFRvYXN0VHlwZSkgPT4gKGI6IHN0cmluZykgPT4gKG5ldyBUb2FzdChhLCBiKSkuaW5pdCgpXG5cbmV4cG9ydCBjb25zdCBkYW5nZXJUb2FzdCA9IGN1cnJ5VG9hc3QoJ2Vycm9yJylcbmV4cG9ydCBjb25zdCBzdWNjZXNzVG9hc3QgPSBjdXJyeVRvYXN0KCdzdWNjZXNzJykiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCIvLyBUaGUgbW9kdWxlIGNhY2hlXG52YXIgX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fID0ge307XG5cbi8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG5mdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuXHR2YXIgY2FjaGVkTW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXTtcblx0aWYgKGNhY2hlZE1vZHVsZSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0cmV0dXJuIGNhY2hlZE1vZHVsZS5leHBvcnRzO1xuXHR9XG5cdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG5cdHZhciBtb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdID0ge1xuXHRcdC8vIG5vIG1vZHVsZS5pZCBuZWVkZWRcblx0XHQvLyBubyBtb2R1bGUubG9hZGVkIG5lZWRlZFxuXHRcdGV4cG9ydHM6IHt9XG5cdH07XG5cblx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG5cdF9fd2VicGFja19tb2R1bGVzX19bbW9kdWxlSWRdKG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG5cdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG5cdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbn1cblxuIiwiLy8gZGVmaW5lIGdldHRlciBmdW5jdGlvbnMgZm9yIGhhcm1vbnkgZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5kID0gKGV4cG9ydHMsIGRlZmluaXRpb24pID0+IHtcblx0Zm9yKHZhciBrZXkgaW4gZGVmaW5pdGlvbikge1xuXHRcdGlmKF9fd2VicGFja19yZXF1aXJlX18ubyhkZWZpbml0aW9uLCBrZXkpICYmICFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywga2V5KSkge1xuXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIGtleSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGRlZmluaXRpb25ba2V5XSB9KTtcblx0XHR9XG5cdH1cbn07IiwiX193ZWJwYWNrX3JlcXVpcmVfXy5vID0gKG9iaiwgcHJvcCkgPT4gKE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmosIHByb3ApKSIsIi8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uciA9IChleHBvcnRzKSA9PiB7XG5cdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuXHR9XG5cdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG59OyIsImltcG9ydCB7IGRhbmdlclRvYXN0LCBzdWNjZXNzVG9hc3QgfSBmcm9tIFwiLi9tb2R1bGVzL3RvYXN0XCJcbmltcG9ydCB7IF9xdWVyeSB9IGZyb20gXCIuL21vZHVsZXMvcXVlcnlcIlxuaW1wb3J0IFBvcHVwTG9hZGVyIGZyb20gXCIuL21vZHVsZXMvcG9wdXBcIlxuXG5pbXBvcnQgXCIuL3Nhc3MvZnJvbnQuc2Nzc1wiXG5pbXBvcnQgeyBPcmRlckxpc3RJdGVtIH0gZnJvbSBcIi4vdHlwZXMvdHlwZXNcIlxuXG5jb25zdCBnZXRPcmRlckxpc3RUb1JldHVybiA9ICgpOiBPcmRlckxpc3RJdGVtW10gPT4ge1xuICAgIHJldHVybiBvcmRlcnNfbGlzdDtcbn1cblxuY29uc3QgZ2V0UmV0dXJuTGluayA9ICgpOiBzdHJpbmcgPT4ge1xuICAgIHJldHVybiByZXR1cm5fbGluaztcbn1cblxuY2xhc3MgQWRkUmV0dXJuIHtcblxuICAgIHByaXZhdGUgcG9wdXA6IFBvcHVwTG9hZGVyXG4gICAgcHJpdmF0ZSB3cmFwcGVySW5wdXQ6IEhUTUxFbGVtZW50XG5cbiAgICBjb25zdHJ1Y3RvcihwdWJsaWMgYWRkUmV0dXJuOiBIVE1MRWxlbWVudCkge1xuICAgICAgICB0aGlzLmFkZFJldHVybi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGV2ZW50ID0+IHRoaXMuYWRkKCkpXG4gICAgICAgIHRoaXMucG9wdXAgPSBuZXcgUG9wdXBMb2FkZXIoKVxuICAgIH1cblxuICAgIGFkZCgpIHtcbiAgICAgICAgdGhpcy5wb3B1cC5zdGFydCgpLmhpZGVMb2FkZXIoKS5wb3B1cC5hcHBlbmRDaGlsZChcbiAgICAgICAgICAgIHRoaXMucGF0dGVyblxuICAgICAgICApXG4gICAgfVxuXG4gICAgZ2V0IHBhdHRlcm4oKTogSFRNTEVsZW1lbnQge1xuICAgICAgICBsZXQgd3JhcHBlciA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2RpdicpLFxuICAgICAgICAgICAgaW5wdXQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdpbnB1dCcpLFxuICAgICAgICAgICAgYnV0dG9uID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnYnV0dG9uJylcbiAgICAgICAgO1xuXG4gICAgICAgIHdyYXBwZXIuY2xhc3NMaXN0LmFkZCgnd3JhcC1hZGQtb3JkZXJzJylcbiAgICAgICAgd3JhcHBlci5hcHBlbmRDaGlsZChpbnB1dClcbiAgICAgICAgd3JhcHBlci5hcHBlbmRDaGlsZChidXR0b24pXG5cbiAgICAgICAgaW5wdXQucGxhY2Vob2xkZXIgPSBcIkVudHJleiBsYSByZWZlcmVuY2UgZGUgbGEgY29tbWFuZGVcIlxuXG4gICAgICAgIGJ1dHRvbi5pbm5lckhUTUwgPSAnQWRkJztcbiAgICAgICAgYnV0dG9uLmNsYXNzTGlzdC5hZGQoJ2J0bicpXG4gICAgICAgIGJ1dHRvbi5jbGFzc0xpc3QuYWRkKCdidG4tZGVmYXVsdCcpXG5cbiAgICAgICAgYnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZXZlbnQgPT4gdGhpcy5hZGRSZXR1cm5PcmRlcihpbnB1dC52YWx1ZSkpXG4gICAgICAgIHRoaXMud3JhcHBlcklucHV0ID0gd3JhcHBlclxuICAgICAgICByZXR1cm4gd3JhcHBlclxuICAgIH1cblxuICAgIGFkZFJvd1JldHVybih7cmVmLCByZXQsIGFtLCBkYSwgYWN9OiB7cmVmOiBzdHJpbmcsIHJldDogc3RyaW5nLCBhbTogc3RyaW5nLCBkYTogc3RyaW5nLCBhYzogc3RyaW5nIH0pIHtcbiAgICAgICAgbGV0IHRyID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgndHInKSxcbiAgICAgICAgICAgIHJlZmVyZW5jZSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3RkJyksXG4gICAgICAgICAgICByZXR1cm5JRCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3RkJyksXG4gICAgICAgICAgICBhbW91bnQgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCd0ZCcpLFxuICAgICAgICAgICAgZGF0ZUFkZCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3RkJyksXG4gICAgICAgICAgICBhY3Rpb24gPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCd0ZCcpXG4gICAgICAgIDtcblxuICAgICAgICB0ci5hcHBlbmRDaGlsZChyZWZlcmVuY2UpXG4gICAgICAgIHRyLmFwcGVuZENoaWxkKHJldHVybklEKVxuICAgICAgICB0ci5hcHBlbmRDaGlsZChhbW91bnQpXG4gICAgICAgIHRyLmFwcGVuZENoaWxkKGRhdGVBZGQpXG4gICAgICAgIHRyLmFwcGVuZENoaWxkKGFjdGlvbilcblxuICAgICAgICByZWZlcmVuY2UuaW5uZXJIVE1MID0gcmVmO1xuICAgICAgICByZXR1cm5JRC5pbm5lckhUTUwgPSByZXQ7XG4gICAgICAgIGFtb3VudC5pbm5lckhUTUwgPSBhbTtcbiAgICAgICAgZGF0ZUFkZC5pbm5lckhUTUwgPSBkYTtcbiAgICAgICAgYWN0aW9uLmlubmVySFRNTCA9IGFjO1xuXG4gICAgICAgIGNvbnNvbGUubG9nKGFjLCBhY3Rpb24pXG5cbiAgICAgICAgbGV0IHRib2R5ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNjLXJldHVybnMgdGJvZHknKVxuXG4gICAgICAgIGlmKHRib2R5KSB7XG4gICAgICAgICAgICB0Ym9keS5hcHBlbmRDaGlsZCh0cilcbiAgICAgICAgfVxuICAgIH1cblxuICAgIGFzeW5jIGFkZFJldHVybk9yZGVyKHJlZmVyZW5jZTogc3RyaW5nKSB7XG4gICAgICAgIGxldCBvcmRlckl0ZW0gPSBnZXRPcmRlckxpc3RUb1JldHVybigpLmZpbmQoYSA9PiBhLnJlZmVyZW5jZSA9PSByZWZlcmVuY2UpXG5cbiAgICAgICAgaWYob3JkZXJJdGVtKSB7XG4gICAgICAgICAgICB0aGlzLnBvcHVwLnNob3dMb2FkZXIoKVxuICAgICAgICAgICAgdGhpcy53cmFwcGVySW5wdXQuY2xhc3NMaXN0LmFkZCgnaXMtaGlkZGVuJylcblxuICAgICAgICAgICAgbGV0IHJlcyA9IGF3YWl0IF9xdWVyeS5wb3N0KGdldFJldHVybkxpbmsoKSwgbmV3IFVSTFNlYXJjaFBhcmFtcyh7XG4gICAgICAgICAgICAgICAgaXNfYWpheDogXCIxXCIsXG4gICAgICAgICAgICAgICAgcmVmZXJlbmNlOiBvcmRlckl0ZW0ucmVmZXJlbmNlLFxuICAgICAgICAgICAgICAgIGlkX29yZGVyOiBvcmRlckl0ZW0uaWRfb3JkZXIsXG4gICAgICAgICAgICAgICAgc3VibWl0QWRkUmV0dXJuOiBcIjFcIlxuICAgICAgICAgICAgfSkpO1xuXG4gICAgICAgICAgICBpZihyZXMgJiYgcmVzLnN1Y2Nlc3MgPT0gdHJ1ZSkge1xuICAgICAgICAgICAgICAgIGlmKHR5cGVvZiByZXMucmV0dXJuICE9PSBcInVuZGVmaW5lZFwiKSB7XG4gICAgICAgICAgICAgICAgICAgIHRoaXMuYWRkUm93UmV0dXJuKHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldDogcmVzLnJldHVybi5vcmRlcl9yZXR1cm4sXG4gICAgICAgICAgICAgICAgICAgICAgICByZWY6IHJlcy5yZXR1cm4ucmVmZXJlbmNlLFxuICAgICAgICAgICAgICAgICAgICAgICAgYWM6IHJlcy5yZXR1cm4ubGluayxcbiAgICAgICAgICAgICAgICAgICAgICAgIGRhOiByZXMucmV0dXJuLmRhdGVfYWRkLFxuICAgICAgICAgICAgICAgICAgICAgICAgYW06IHJlcy5yZXR1cm4uYW1vdW50LFxuICAgICAgICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICBzdWNjZXNzVG9hc3QoJ1ZvdHJlIGNvbW1hbmRlIMOgIMOpdMOpIGFqb3V0ZXIgY29tbWUgcmV0b3VyJylcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgZGFuZ2VyVG9hc3QocmVzLm1zZyB8fCAnSW1wb3NzaWJsZSBkXFwnYWpvdXRlciBsYSBjb21tYW5kZSBjb21tZSByZXRvdXInKVxuICAgICAgICAgICAgfVxuXG4gICAgICAgICAgICB0aGlzLnBvcHVwLnN0b3AoKVxuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgZGFuZ2VyVG9hc3QoJ0NldHRlIGNvbW1hbmRlIG5cXCdleGlzdGUgcGFzJylcbiAgICAgICAgfVxuICAgIH1cbn1cblxud2luZG93LmFkZEV2ZW50TGlzdGVuZXIoJ0RPTUNvbnRlbnRMb2FkZWQnLCAoKSA9PiB7XG4gICAgbGV0IGFkZFJldHVybiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3I8SFRNTEVsZW1lbnQ+KCcuc2MtcmV0dXJucyAuYWRkLXJldHVybicpO1xuXG4gICAgaWYoYWRkUmV0dXJuKSB7XG4gICAgICAgbmV3IEFkZFJldHVybihhZGRSZXR1cm4pXG4gICAgfVxufSkiXSwibmFtZXMiOltdLCJzb3VyY2VSb290IjoiIn0=