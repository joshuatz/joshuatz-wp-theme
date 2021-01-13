<?php
    // Nav processing
    global $jtzwpHelpers;
    $projectTerms = $jtzwpHelpers->getProjectTypesTerms();
?>
<?php
    // Easy nav settings
    $navBreakpoint = 980;
    $navBreakpointPx = '' . $navBreakpoint . 'px';
?>

<div id='masthead' role='banner' class="mainNavContainerWrapper">
    <div class="jtcontainer" id='mainNavContainer'>
        <div class="jtnavbar jtnavbar-inverse">
            <div class="jtnavbar-inner">
                <div class="btn-jtnavbar jtcollapsed" data-target='.nav-jtcollapse' data-toggle='jtcollapse' type='button'>
                    <svg enable-background="new 0 0 512 512" height="512px" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><rect height="64" width="256" x="128" y="320"/><rect height="64" width="256" x="128" y="224"/><path d="M480,0H32C14.312,0,0,14.312,0,32v448c0,17.688,14.312,32,32,32h448c17.688,0,32-14.312,32-32V32   C512,14.312,497.688,0,480,0z M448,448H64V64h384V448z"/><rect height="64" width="256" x="128" y="128"/></g></svg>
                </div>
                <div class="header" id='header'>
                    <div class="widget Header" data-version='1' id='Header1'>
                        <div id='header-inner'>
                            <div class="titlewrapper">
                                <div class="title">
                                    <a href='/'>Joshuatz.com</a>
                                </div>
                            </div>
                            <div class="descriptionwrapper">
                                <p class="description"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-jtcollapse jtcollapse">
                    <ul class="nav" id='menu-primary'>
                        <?php if(!is_front_page()): ?>
                        <li>
                            <a href='/'>Home</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <?php
                            // The business card materialize modal can really only be reliably shown on WP pages, so change to link to homepage and about popup if on non wp
                            $aboutMeLink = $jtzwpHelpers->isPageWP()===true ? '#businessCardMaterializeModal' : '/#businessCardMaterializeModal';
                            $aboutMeTarget = $jtzwpHelpers->isPageWP()===true ? '_self' : '_blank';
                            ?>
                            <?php if(!is_front_page()): ?>
                                <a href="<?php echo $aboutMeLink; ?>" id="linkedIn" class="modal-trigger" target="<?php echo $aboutMeTarget; ?>" ga-on="click" ga-event-category="Social" ga-event-label="About Me Click">About / Contact</a>
                            <?php endif; ?>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle='dropdown' href='#'>Projects</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown">
                                    <a href="/projects/">All</a>
                                </li>
                                <?php foreach($projectTerms as $projectTerm): ?>
                                <li class="dropdown">
                                    <a href="<?php echo get_term_link($projectTerm);?>">|--> <?php echo $projectTerm->name; ?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li>
                            <a href="/custom-tools/">One-Off Tools</a>
                        </li>
                        <li>
                            <a href="/blog/">Blog</a>
                        </li>
                    </ul>
                </div>
                <div id="nav-search-wrapper">
                    <div class="bl_search nav-jtcollapse jtcollapse">
                        <div class="siteSearchWrapper">
                            <form id="siteSearchForm">
                                <input type="text" class="siteSearchInput" autocomplete="off" placeholder="search" aria-label="Site search box" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="fullHeightEnd" style="height:100%; width:1px;"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<!-- Scripts -->
<script>
var G = "/", C = location.href, H, D, B, F;
!function(a) {
    a(function() {
        a.support.transition = function() {
            var a = function() {
                var a = document.createElement("bootstrap"), b = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                }, c;
                for (c in b)
                    if (a.style[c] !== undefined)
                        return b[c]
            }();
            return a && {
                end: a
            }
        }()
    })
}(window.jQuery),
!function(a) {
    var b = function(b) {
        this.element = a(b)
    };
    b.prototype = {
        constructor: b,
        show: function() {
            var b = this.element, c = b.closest("ul:not(.dropdown-menu)"), d = b.attr("data-target"), e, f, g;
            d || (d = b.attr("href"),
            d = d && d.replace(/.*(?=#[^\s]*$)/, ""));
            if (b.parent("li").hasClass("active"))
                return;
            e = c.find(".active:last a")[0],
            g = a.Event("show", {
                relatedTarget: e
            }),
            b.trigger(g);
            if (g.isDefaultPrevented())
                return;
            f = a(d),
            this.activate(b.parent("li"), c),
            this.activate(f, f.parent(), function() {
                b.trigger({
                    type: "shown",
                    relatedTarget: e
                })
            })
        },
        activate: function(b, c, d) {
            function g() {
                e.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),
                b.addClass("active"),
                f ? (b[0].offsetWidth,
                b.addClass("in")) : b.removeClass("fade"),
                b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active"),
                d && d()
            }
            var e = c.find("> .active")
              , f = d && (a.support.transition && e.hasClass("fade"));
            f ? e.one(a.support.transition.end, g) : g(),
            e.removeClass("in")
        }
    };
    var c = a.fn.tab;
    a.fn.tab = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("tab");
            e || d.data("tab", e = new b(this)),
            typeof c == "string" && e[c]()
        })
    },
    a.fn.tab.Constructor = b,
    a.fn.tab.noConflict = function() {
        return a.fn.tab = c,
        this
    },
    a(document).on("click.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function(b) {
        b.preventDefault(),
        a(this).tab("show")
    })
}(window.jQuery),
!function(a) {
    var b = function(b, c) {
        this.$element = a(b),
        this.options = a.extend({}, a.fn.jtcollapse.defaults, c),
        this.options.parent && (this.$parent = a(this.options.parent)),
        this.options.toggle && this.toggle()
    }
    ;
    b.prototype = {
        constructor: b,
        dimension: function() {
            var a = this.$element.hasClass("width");
            return a ? "width" : "height"
        },
        show: function() {
            var b, c, d, e;
            if (this.transitioning || this.$element.hasClass("in"))
                return;
            b = this.dimension(),
            c = a.camelCase(["scroll", b].join("-")),
            d = this.$parent && this.$parent.find("> .accordion-group > .in");
            if (d && d.length) {
                e = d.data("jtcollapse");
                if (e && e.transitioning)
                    return;
                d.jtcollapse("hide"),
                e || d.data("jtcollapse", null )
            }
            this.$element[b](0),
            this.transition("addClass", a.Event("show"), "shown"),
            a.support.transition && this.$element[b](this.$element[0][c])
        },
        hide: function() {
            var b;
            if (this.transitioning || !this.$element.hasClass("in"))
                return;
            b = this.dimension(),
            this.reset(this.$element[b]()),
            this.transition("removeClass", a.Event("hide"), "hidden"),
            this.$element[b](0)
        },
        reset: function(a) {
            var b = this.dimension();
            return this.$element.removeClass("jtcollapse")[b](a || "auto")[0].offsetWidth,
            this.$element[a !== null ? "addClass" : "removeClass"]("jtcollapse"),
            this
        },
        transition: function(b, c, d) {
            var e = this
              , f = function() {
                c.type == "show" && e.reset(),
                e.transitioning = 0,
                e.$element.trigger(d)
            }
            ;
            this.$element.trigger(c);
            if (c.isDefaultPrevented())
                return;
            this.transitioning = 1,
            this.$element[b]("in"),
            a.support.transition && this.$element.hasClass("jtcollapse") ? this.$element.one(a.support.transition.end, f) : f()
        },
        toggle: function() {
            this[this.$element.hasClass("in") ? "hide" : "show"]()
        }
    };
    var c = a.fn.jtcollapse;
    a.fn.jtcollapse = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("jtcollapse")
              , f = a.extend({}, a.fn.jtcollapse.defaults, d.data(), typeof c == "object" && c);
            e || d.data("jtcollapse", e = new b(this,f)),
            typeof c == "string" && e[c]()
        })
    }
    ,
    a.fn.jtcollapse.defaults = {
        toggle: true
    },
    a.fn.jtcollapse.Constructor = b,
    a.fn.jtcollapse.noConflict = function() {
        return a.fn.jtcollapse = c,
        this
    },
    a(document).on("click.jtcollapse.data-api", "[data-toggle=jtcollapse]", function(b) {
        var c = a(this), d, e = c.attr("data-target") || (b.preventDefault() || (d = c.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, "")), f = a(e).data("jtcollapse") ? "toggle" : c.data();
        c[a(e).hasClass("in") ? "addClass" : "removeClass"]("jtcollapsed"),
        a(e).jtcollapse(f)
    })
}(window.jQuery);

</script>
<!-- End Scripts -->

<style>
.siteSearchWrapper {
    padding: 4px 20px;
    max-width: 250px;
    text-align: center;
    margin: auto;
}
.siteSearchInput {
    color: white;
    padding-left: 15px !important;
}
#nav-search-wrapper {
    overflow: hidden;
}
div.nav-collapse.collapse {
    float:left;
}

.nav {
    margin-left: 0;
    margin-bottom: 20px;
    list-style: none
}

.nav>li>a {
    display: block
}

.jtnavbar {
    overflow: visible;
    margin-bottom: 20px;
    *position: relative;
    *z-index: 2
}

.jtnavbar-inner {
    min-height: 40px;
    padding-left: 20px;
    padding-right: 20px;
    background-color: #fafafa;
    background-image: -moz-linear-gradient(top, #fff, #f2f2f2);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#fff), to(#f2f2f2));
    background-image: -webkit-linear-gradient(top, #fff, #f2f2f2);
    background-image: -o-linear-gradient(top, #fff, #f2f2f2);
    background-image: linear-gradient(to bottom, #fff, #f2f2f2);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffff', endColorstr='#fff2f2f2', GradientType=0);
    border: 1px solid #d4d4d4;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.065);
    *zoom: 1
}
.jtnavbar-inner a {
    color: white;
}

.jtnavbar-inner:before, .jtnavbar-inner:after {
    display: table;
    content: "";
    line-height: 0
}

.jtnavbar-inner:after {
    clear: both
}

.nav-jtcollapse.jtcollapse {
    overflow: visible
}

.jtnavbar .nav {
    position: relative;
    left: 0;
    display: block;
    float: left;
    margin: 0 10px 0 0
}

.jtnavbar .nav>li {
    float: left
}

.jtnavbar .nav>li>a {
    float: none;
    padding: 10px 15px 10px;
    color: #777;
    text-decoration: none;
    text-shadow: 0 1px 0 #fff
}

.jtnavbar .nav>li>a:focus, .jtnavbar .nav>li>a:hover {
    background-color: transparent;
    color: #333;
    text-decoration: none
}

.jtnavbar .nav>li>.dropdown-menu:before {
    content: '';
    display: inline-block;
    border-left: 7px solid transparent;
    border-right: 7px solid transparent;
    border-bottom: 7px solid #ccc;
    border-bottom-color: rgba(0, 0, 0, 0.2);
    position: absolute;
    top: -7px;
    left: 9px
}

.jtnavbar .nav>li>.dropdown-menu:after {
    content: '';
    display: inline-block;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 6px solid #fff;
    position: absolute;
    top: -6px;
    left: 10px
}

.jtnavbar-inverse .jtnavbar-inner {
    background-color: #1b1b1b;
    background-image: -moz-linear-gradient(top, #222, #111);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#222), to(#111));
    background-image: -webkit-linear-gradient(top, #222, #111);
    background-image: -o-linear-gradient(top, #222, #111);
    background-image: linear-gradient(to bottom, #222, #111);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2222', endColorstr='#f1111', GradientType=0);
    border-color: #252525
}

.jtnavbar-inverse .nav>li>a {
    color: #999;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25)
}

.jtnavbar-inverse .nav>li>a:hover, .jtnavbar-inverse .nav>li>a:focus {
    color: #fff
}

.jtnavbar-inverse .nav>li>a:focus, .jtnavbar-inverse .nav>li>a:hover {
    background-color: rgba(255, 255, 255, 0.18);
    color: #fff
}

.dropup, .dropdown {
    position: relative
}

.dropdown-toggle {
    margin-bottom: -3px
}

.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    list-style: none;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    *border-right-width: 2px;
    *border-bottom-width: 2px;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: normal;
    line-height: 20px;
    color: #333;
    white-space: nowrap
}

.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus, .dropdown-submenu:hover>a, .dropdown-submenu:focus>a {
    text-decoration: none;
    color: #fff;
    background-color: #0081c2;
    background-image: -moz-linear-gradient(top, #08c, #0077b3);
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#08c), to(#0077b3));
    background-image: -webkit-linear-gradient(top, #08c, #0077b3);
    background-image: -o-linear-gradient(top, #08c, #0077b3);
    background-image: linear-gradient(to bottom, #08c, #0077b3);
    background-repeat: repeat-x;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f08cc', endColorstr='#f07b3', GradientType=0)
}

.jtcollapse {
    position: relative;
    height: 0;
    overflow: hidden;
    transition: height 0.35s ease
}

.jtnavbar-inverse .jtnavbar-inner {
    background: transparent;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border: none;
    padding: 0 15px;
    filter: none
}

.jtnavbar {
    margin-bottom: 0
}

.jtnavbar .nav>li>a {
    color: #EFEFEF;
    display: block;
    font-size: 1rem;
    font-weight: 300;
    line-height: 25px;
    padding: 23px 20px 20px;
    text-decoration: none;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -o-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out
}

.jtnavbar .nav>li>a:focus+ul {
    display: block
}
.jtnavbar-inverse .nav>li>a {
    text-shadow: none
}

.jtnavbar-inverse .nav-jtcollapse .nav>li>a, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a {
    color: #EFEFEF
}

.jtnavbar .nav>li.active, .jtnavbar .nav>li:hover {
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0.02);
    color: #fff
}
.dropdown-menu {
    background: none repeat scroll 0 0 #212833;
    border-top: 2px solid #F69087;
    border-left: 0;
    border-right: 0;
    border-radius: 0;
    padding: 0;
    margin: 0
}

.dropdown-menu>li>a {
    color: #FFF;
    font-size: 1rem;
    padding: 15px 20px
}

.jtnavbar .nav>li>.dropdown-menu:after, .jtnavbar .nav>li>.dropdown-menu:before {
    display: none
}

.jtnavbar .nav>li:hover>ul {
    display: block
}

.dropdown-menu>li>a:hover {
    background: #38404B
}

.jtnavbar-inverse .nav li.dropdown.open>.dropdown-toggle, .jtnavbar-inverse .nav li.dropdown.active>.dropdown-toggle, .jtnavbar-inverse .nav li.dropdown.open.active>.dropdown-toggle {
    background: none repeat scroll 0 0 #212833
}

.jtnavbar .btn-jtnavbar {
    cursor: pointer;
    margin: 25px 5px 5px 5px;
    padding: 0px 10px;
    -webkit-appearance: inherit;
    float: right;
    color: #fff;
}
.jtnavbar .btn-jtnavbar svg {
    width: 40px;
    height: 35px;
    fill: white;
}

.nav-jtcollapse .nav>li>a, .nav-jtcollapse .dropdown-menu a {
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0
}

#masthead {
    height: 75px;
    background: #2E3641;
    margin-bottom: 50px;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999
}

/* If width is SMALLER than breakpoint */
@media (max-width: <?php echo $navBreakpointPx; ?>){
    #masthead .titlewrapper .title {
        font-weight:normal;
        line-height:20px;
        margin-top:20px;
        margin-left:30px;
        font-size: 32px;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    #header-inner > .titlewrapper {
        position: relative;
    }
    #main {
        padding-top: 85px;
        margin-top: 0px;
    }
    .jtnavbar .btn-jtnavbar {
        display: block;
    }
    .nav-jtcollapse {
        clear: both;
    }

    .nav-jtcollapse .nav {
        float: none;
        margin: 0 0 10px;
    }

    .nav-jtcollapse .nav>li {
        float: none;
    }

    .nav-jtcollapse .nav>li>a {
        margin-bottom: 2px;
    }

    .nav-jtcollapse .nav>li>a,
    .nav-jtcollapse .dropdown-menu a {
        padding: 9px 15px;
        font-weight: bold;
        color: #777777;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .nav-jtcollapse .dropdown-menu li+li a {
        margin-bottom: 2px;
    }

    .nav-jtcollapse .nav>li>a:hover,
    .nav-jtcollapse .nav>li>a:focus,
    .nav-jtcollapse .dropdown-menu a:hover,
    .nav-jtcollapse .dropdown-menu a:focus {
        background-color: #f2f2f2;
    }

    .jtnavbar-inverse .nav-jtcollapse .nav>li>a,
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a {
        color: #999999;
    }

    .jtnavbar-inverse .nav-jtcollapse .nav>li>a:hover,
    .jtnavbar-inverse .nav-jtcollapse .nav>li>a:focus,
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus {
        background-color: #111111;
    }

    .nav-jtcollapse .dropdown-menu {
        position: static;
        top: auto;
        left: auto;
        float: none;
        display: none;
        max-width: none;
        margin: 0 15px;
        padding: 0;
        background-color: transparent;
        border: none;
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
    }

    .nav-jtcollapse .open>.dropdown-menu {
        display: block;
    }

    .nav-jtcollapse .dropdown-menu:before,
    .nav-jtcollapse .dropdown-menu:after {
        display: none;
    }

    .nav-jtcollapse .nav>li>.dropdown-menu:before, .nav-jtcollapse .nav>li>.dropdown-menu:after {
        display: none;
    }
    
    .nav-jtcollapse, .nav-jtcollapse.jtcollapse {
        overflow: hidden;
    }
}

/* If width is LARGER than breakpoint */
@media (min-width: <?php echo $navBreakpointPx; ?>){
    #masthead .titlewrapper .title {
        font-size : 38px;
        margin-top: 7px;
    }
    #main {
        padding-top : 75px;
        margin-top: 0px;
    }
    #nav-search-wrapper {
        width: auto;
    }
    .jtnavbar .btn-jtnavbar {
        display: none;
    }
    .nav-jtcollapse.jtcollapse {
        height: auto !important;
        overflow: visible !important;
    }
}

.top-color div {
    float: left;
    height: 5px;
    width: 25%
}

.jtcontainer {
    margin-right: auto;
    margin-left: auto;
    *zoom: 1
}

.jtcontainer:before, .jtcontainer:after {
    display: table;
    content: "";
    line-height: 0
}

.jtcontainer:after {
    clear: both
}

#header {
    float: left
}

#header, #header a {
    color: #FFF
}

@media (min-width: 768px) and (max-width: 979px) {
    .jtcontainer {
        width: auto
    }

    #masthead .bl_search {
        float: none;
        margin: 0
    }

    .jtnavbar-inverse .jtnavbar-inner {
        padding: 0;
        background: 0 0 #2E3641
    }

    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus {
        background: transparent;
        color: #F69087
    }

    .jtnavbar .nav>li>a {
        border-left: 3px solid transparent
    }

    .jtnavbar .nav>li>a:hover, .jtnavbar .nav>li>a:active, .jtnavbar .nav>li>a:focus {
        border-left: 3px solid #85CCB1
    }

    .jtnavbar-inverse .nav-jtcollapse .nav>li>a:hover, .jtnavbar-inverse .nav-jtcollapse .nav>li>a:focus, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus {
        background: transparent
    }

    .nav-jtcollapse .nav>li>a, .nav-jtcollapse .dropdown-menu a {
        font-weight: normal;
        padding: 12px 15px;
        margin: 0
    }
}

@media (max-width: 767px) {
    .jtnavbar .nav>li>a:hover, .jtnavbar .nav>li>a:active, .jtnavbar .nav>li>a:focus {
        border-left: 3px solid #85CCB1
    }
    
    .nav-jtcollapse .dropdown-menu {
        background: #38404B;
        margin: 0
    }
    
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus {
        background: transparent;
        color: #F69087
    }
    
    .jtnavbar-inverse .jtnavbar-inner {
        padding: 0
    }
    
    .jtnavbar-inverse .jtnavbar-inner {
        background: #2E3641
    }
    
    .jtnavbar-inverse .nav-jtcollapse .nav>li>a:hover, .jtnavbar-inverse .nav-jtcollapse .nav>li>a:focus, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover, .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus {
        background: transparent
    }
    
    .nav-jtcollapse .nav>li>a, .nav-jtcollapse .dropdown-menu a {
        font-weight: normal;
        padding: 12px 15px;
        margin: 0
    }
    
    .nav-jtcollapse .open>.dropdown-menu {
        background: #212833;
        margin: 0
    }
}

/* ===== Fix for hover overlay on LinkedIn Icon in Nav =====*/
ul.nav a#linkedIn {
    padding-bottom: 13px;
}

/* More responsive */
ul.nav {
    padding-left: 0px !important;
}

#nav-search-wrapper {
    margin-right: 0px !important;
    padding-right: 0px !important;
    margin-top: 0px;
}

.clearfix {
    *zoom: 1
}

.clearfix:before, .clearfix:after {
    display: table;
    content: "";
    line-height: 0
}

.clearfix:after {
    clear: both
}
</style>

<script>
(function($){
    $(document).ready(function(){

        function offsetNavFromAdminBar(){
            var wpAdminBarElem = document.querySelector('div#wpadminbar');
            if (typeof(wpAdminBarElem)==='object' && wpAdminBarElem!==null){
                var wpAdminBarHeight = window.getComputedStyle(wpAdminBarElem).height;
                $('.mainNavContainerWrapper').css({
                    'top' : wpAdminBarHeight
                });
            }
        }

        function getOffsetFromTop(OPT_IncludeWpAdminBarHeight){
            var includeAdminBarHeight = typeof(OPT_IncludeWpAdminBarHeight)==='boolean' ? OPT_IncludeWpAdminBarHeight : false;
            var masthead = $('#masthead')[0];
            var topColorBar = $('#masthead > .top-color')[0];
            var mainNav = $('#mainNavContainer .jtnavbar-inner')[0];
            var innermostNav = $('#mainNavContainer #menu-primary')[0];
            var wpAdminBar = $('#wpadminbar')[0];
            var topColorBarHeight = topColorBar ? parseFloat(getComputedStyle(topColorBar).height.replace('px','')): 0;
            var mainNavHeight = parseFloat(getComputedStyle(mainNav).height.replace('px',''));
            var mastheadTop = parseFloat(getComputedStyle(masthead).top.replace('px',''));
            var innermostNavHeight = parseFloat(getComputedStyle(innermostNav).height.replace('px',''));
            var wpAdminBarHeight = 0;
            //var mastheadTop = 0;
            if (typeof(wpAdminBar)!=='undefined'){
                wpAdminBarHeight = parseFloat(getComputedStyle(wpAdminBar).height.replace('px',''));
            }
            // Quirk - can't find padding off by few px when not collapsed, so get more accurate inner nav height if not collapsed
            if (innermostNavHeight < mainNavHeight){
                mainNavHeight = innermostNavHeight;
            }
            // If you are trying to offset inner content, you probably want to subtract wpadminbarheight, otherwise, if you are trying to get offset from top, you probably want to add it
            if (!includeAdminBarHeight) {
                wpAdminBarHeight = wpAdminBarHeight * -1;
            }
            var offsetFromTop = mainNavHeight + topColorBarHeight + mastheadTop + wpAdminBarHeight;

            return offsetFromTop;
        }
        function offsetMainFromTop(){
            var newOffset = getOffsetFromTop();
            $('#main').css({
                'padding-top' : newOffset + 'px'
            });
        }

        function navKludge(){
            // offset should be nav height + top-color-bar height + masthead top offset
            offsetNavFromAdminBar();
            setTimeout(function(){
                offsetMainFromTop();
            },10);
        }
        navKludge();

        // Since nav bar is fixed, on resize need to get new height and offset main (which is not fixed) by height
        $(window).on('resize',function(){
            navKludge();
        });

        // Kludge to offset window jump on hash change due to navbar overlapping screen
        function applyNavHashJumpOffsetFixer(){
            var shifted = false;
            var shiftWindow = function() {
                var totalTopOffset = getOffsetFromTop(true);
                scrollBy(0,-(totalTopOffset));
                shifted = true;
                console.log('Hash jump - fix applied');
            };

            var checkHashAndShift = function(){
                if (window.location.hash !== '' && ($(window.location.hash).length > 0)){
                    console.log('On page load, hash detected - fix applied');
                    shiftWindow();
                }
            }

            window.addEventListener('hashchange', checkHashAndShift);

            window.addEventListener('click',function(e){
                var linkClicked = e.target;
                if (linkClicked && /#/.test(linkClicked)){
                    // make sure that link is actually to a valid element
                    if ($(linkClicked).length > 0){
                        shifted = false;
                        console.log('hash link clicked!');
                        setTimeout(function(){
                            // if hashchange listener did not catch page jump because hash stayed the same, apply fix
                            if (shifted == false){ 
                                shiftWindow();
                            }
                        },50);
                    }
                }
            });

            window.addEventListener('load',function(){
                checkHashAndShift();
            });
        }
        applyNavHashJumpOffsetFixer();
    });
})(jQuery)
</script>
<div id="businessCardMaterializeModal" class=" businessCardMaterializeModal modal" data-opacity="0.9">
    <div class="modal-content">
        <?php get_template_part('partials/about-me-card'); ?>
        <?php get_template_part('partials/business-card-materialize'); ?>
    </div>
</div>