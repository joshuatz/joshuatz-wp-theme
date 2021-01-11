/**
 * Helpers
 */
(function () {
    window.helpers = {
        /**
         * Cookie manipulation
         * https://plainjs.com/javascript/utilities/set-cookie-get-cookie-and-delete-cookie-5/
         */
        getCookie: function (name) {
            var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        },
        setCookie: function (name, value, days, sameSite = 'Lax') {
            var d = new Date();
            d.setTime(d.getTime() + 24 * 60 * 60 * 1000 * days);
            var sameSiteOptions = ['None', 'Lax', 'Strict'];
            if (sameSiteOptions.indexOf(sameSite) == -1) {
                sameSite = 'Lax';
            }
            document.cookie = name + '=' + value + ';path=/;expires=' + d.toGMTString() + ';SameSite=' + sameSite;
        },
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
        qsa: document.querySelectorAll.bind(document),
        qs: document.querySelector.bind(document)
    };
})();
