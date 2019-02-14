/**
 * Helpers
 */
(function($){
    window.helpers = {
        /**
         * Cookie manipulation
         * https://plainjs.com/javascript/utilities/set-cookie-get-cookie-and-delete-cookie-5/
         */
        getCookie : function(name){
            var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return v ? v[2] : null;
        },
        setCookie : function(name, value, days){
            var d = new Date;
            d.setTime(d.getTime() + 24*60*60*1000*days);
            document.cookie = name + "=" + value + ";path=/;expires=" + d.toGMTString();
        },
        deleteCookie : function(name){
            this.setCookie(name,'',-1);
        }
    }
})(jQuery);