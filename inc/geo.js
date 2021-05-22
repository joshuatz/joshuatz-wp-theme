class GeoVisibility {
    static IP_INFO_STORAGE_KEY = 'cachedIpInfo';
    static ENDPOINT = 'https://ipinfo.io'

    /**
     * Get IP info for current IP
     * @param {string} [OPT_token]
     * @returns {Promise<GeoResult>}
     */
    static async getIpInfo(OPT_token) {
        const KEY = this.IP_INFO_STORAGE_KEY;

        // Use cached data first
        if (localStorage.getItem(KEY)) {
            try {
                const res = JSON.parse(localStorage.getItem(KEY));
                return res;
            } catch (e) {
                console.warn(`Invalid JSON stored under ${KEY}`);
            }
        }

        const fetchHeaders = new Headers({
            'Accept': 'application/json'
        });
        if (!!OPT_token) {
            fetchHeaders.append('Authorization', `Bearer ${OPT_token}`);
        }
        const res = await fetch(this.ENDPOINT, {
            headers: fetchHeaders
        });
        return res.json();
    }

    /**
     * Unhide an element based on geographic filter(s)
     * @param {Array<GeoFilter>} filters 
     * @param {string} selector 
     * @param {string} [OPT_token] 
     */
    static async unhideByGeography(filters, selector, OPT_token) {
        const ipInfo = await this.getIpInfo(OPT_token);
        var matchBlocked = false;
        for (var x=0; x<filters.length; x++){
            var filter = filters[x];
            if (typeof(filter.filterVal)==='string'){
                if (!(filter.infoKey in ipInfo)){
                    matchBlocked = true;
                }
                else {
                    matchBlocked = helpers.strToRegExp(filter.filterVal).test(ipInfo[filter.infoKey])===false;
                }
            }
            if (matchBlocked){
                if (isDebug){
                    console.group('Geo content blocked by filter:');
                        console.log(filter);
                    console.groupEnd();
                }
                break;
            }
        }
        if (!matchBlocked){
            const elements = /** @type {NodeListOf<HTMLElement>} */ (document.querySelectorAll(selector));
            elements.forEach((elem) => {
                elem.style.opacity = '0';
                elem.classList.remove('hide');
                setTimeout(function(){
                    elem.style.opacity = '1';
                }, 100);
            });
        }
    }

    /**
     * @param {GeoUnHideRuleSet} set 
     */
    static async unhideByGeographySet(set) {
        return this.unhideByGeography(set.filters, set.selector, set.token);
    }
}

window.unhideByGeographyArr = (window.unhideByGeographyArr || []);

// Clear out existing rule sets
window.unhideByGeographyArr.forEach((set) => {
    GeoVisibility.unhideByGeography
});
/** @param {GeoUnHideRuleSet} set */
window.unhideByGeographyArr.push = function(set){
    GeoVisibility.unhideByGeographySet(set);
    return 0;
};