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
                <a href="/custom-tools/">Custom Developed Tools</a>
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
                        <input type="text" class="siteSearchInput" autocomplete="off" placeholder="search" />
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
    }
    ;
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
    }
    ,
    a.fn.tab.Constructor = b,
    a.fn.tab.noConflict = function() {
        return a.fn.tab = c,
        this
    }
    ,
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
    }
    ,
    a(document).on("click.jtcollapse.data-api", "[data-toggle=jtcollapse]", function(b) {
        var c = a(this), d, e = c.attr("data-target") || (b.preventDefault() || (d = c.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, "")), f = a(e).data("jtcollapse") ? "toggle" : c.data();
        c[a(e).hasClass("in") ? "addClass" : "removeClass"]("jtcollapsed"),
        a(e).jtcollapse(f)
    })
}(window.jQuery);

</script>
<!-- End Scripts -->

<style>
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
            var topColorBarHeight = parseFloat(getComputedStyle(topColorBar).height.replace('px',''));
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