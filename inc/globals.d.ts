export {};

declare global {
    const ga: any;
    const gtag: any;
    const isDebug: boolean;
    const fireEvent: (action: string, category: string, label: string, value: string) => void;
    const PrismToolbar: any;

    interface Window {
        isDebug: typeof isDebug;
        fireEvent: typeof fireEvent;
        gtag: any;
        ga: any;
        baguetteBox: any;
        unhideByGeographyArr?: Array<GeoUnHideRuleSet>;
        jPrismToolbar: any;
    }

    interface GeoResult {
        city: string;
        country: string;
        hostname: string;
        ip: string;
        loc: string;
        org: string;
        postal: string;
        region: string;
        timezone: string;
    }

    interface GeoFilter {
        infoKey?: keyof GeoResult;
        filterVal?: string;
    }

    interface GeoUnHideRuleSet {
        filters: Array<GeoFilter>;
        selector: string;
        token?: string;
    }

    /**
    const wow: WOW;

    class WOW {
        constructor(config?: WowConfig);
        public init(): void;
        public show(elem: HTMLElement): void;
    }

    interface WowConfig {
        boxClass?: string;
        animateClass?: string;
        offset?: number;
        mobile?: boolean;
        live?: boolean;
        callback?: (box: HTMLElement) => void;
        scrollContainer?: string | null;
    }
    */
}