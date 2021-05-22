/**
 * Helpers
 */
const helpers = {
    /**
     * Get cookie by name
     * https://plainjs.com/javascript/utilities/set-cookie-get-cookie-and-delete-cookie-5/
     * @param {string} name
     */
    getCookie: function (name) {
        var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return v ? v[2] : null;
    },
    /**
     * https://plainjs.com/javascript/utilities/set-cookie-get-cookie-and-delete-cookie-5/
     * @param {string} name
     * @param {string} value
     * @param {number} days
     * @param {'None' | 'Lax' | 'Strict'} [sameSite]
     */
    setCookie: function (name, value, days, sameSite = 'Lax') {
        var d = new Date();
        d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
        var sameSiteOptions = ['None', 'Lax', 'Strict'];
        if (sameSiteOptions.indexOf(sameSite) == -1) {
            sameSite = 'Lax';
        }
        document.cookie = name + '=' + value + ';path=/;expires=' + d.toUTCString() + ';SameSite=' + sameSite;
    },
    /**
     * @param {string} name
     */
    deleteCookie: function (name) {
        this.setCookie(name, '', -1);
    },
    /**
     * Fire callback on DOMContentLoaded
     * - Equivalent to $(document).ready(callback)
     * @param {(() => void)} callback
     */
    onDomReady: function (callback) {
        if (document.readyState === 'interactive') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    },
    /** @type {Document['querySelectorAll']} */
    qsa: document.querySelectorAll.bind(document),
    /** @type {Document['querySelector']} */
    qs: document.querySelector.bind(document),
    /** @param {string} e */
    strToRegExp(e) {
        var r = /^\/(.*)\/([igmuy]{0,5})$/;
        if (r.test(e)) {
            var n = r.exec(e)[1],
                t = r.exec(e)[2];
            return new RegExp(n, t);
        }
        return new RegExp(e);
    },
    /**
     * Forces an <img> tag to be wrapped by <a> with href pointing to full size (if available), or just img src
     * @param {HTMLImageElement} imgTag
     * @returns {HTMLAnchorElement} The wrapping anchor tag
     */
    forceImageLinkWrapped: function (imgTag) {
        let parentElem = imgTag.parentElement;

        // Check if already link wrapped
        if (parentElem && parentElem.nodeName === 'A') {
            return /** @type {HTMLAnchorElement} */ (parentElem);
        }

        let linkWrapper = document.createElement('a');
        imgTag.parentElement.insertBefore(linkWrapper, imgTag);

        // Get the link to the full size image, and set it as the href on the link wrapper
        var fullSizeImageLink = imgTag.getAttribute('src').replace(/(-\d+x\d*)(\.[^.]+$)/g, '$2');
        linkWrapper.setAttribute('href', fullSizeImageLink);

        // Move the img tag into the link wrapper
        linkWrapper.appendChild(imgTag);
        return linkWrapper;
    }
};
