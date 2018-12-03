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
<!--Ripped from original site-->
<style>
.nav{margin-left:0;margin-bottom:20px;list-style:none}
.nav>li>a{display:block}
.nav>li>a:hover,.nav>li>a:focus{text-decoration:none;background-color:#eee}
.nav>li>a>img{max-width:none}
.nav>.pull-right{float:right}
.nav-list{padding-left:15px;padding-right:15px;margin-bottom:0}
.nav-list>li>a{padding:3px 15px}
.nav-list>.active>a,.nav-list>.active>a:hover,.nav-list>.active>a:focus{color:#fff;text-shadow:0 -1px 0 rgba(0,0,0,0.2);background-color:#08c}
.nav-list [class^="icon-"],.nav-list [class*=" icon-"]{margin-right:2px}
.nav-list .divider{*width:100%;height:1px;margin:9px 1px;*margin:-5px 0 5px;overflow:hidden;background-color:#e5e5e5;border-bottom:1px solid #fff}
.nav-tabs,.nav-pills{*zoom:1}
.nav-tabs:before,.nav-pills:before,.nav-tabs:after,.nav-pills:after{display:table;content:"";line-height:0}
.nav-tabs:after,.nav-pills:after{clear:both}
.nav-tabs>li,.nav-pills>li{float:left}
.nav-tabs>li>a,.nav-pills>li>a{padding-right:12px;padding-left:12px;margin-right:2px;line-height:14px}
.nav-tabs{border-bottom:1px solid #ddd}
.nav-tabs>li{margin-bottom:-1px}
.nav-tabs>li>a{padding-top:8px;padding-bottom:8px;line-height:20px;border:1px solid transparent;-webkit-border-radius:4px 4px 0 0;-moz-border-radius:4px 4px 0 0;border-radius:4px 4px 0 0}
.nav-tabs>li>a:hover,.nav-tabs>li>a:focus{border-color:#eee #eee #ddd}
.nav-tabs>.active>a,.nav-tabs>.active>a:hover,.nav-tabs>.active>a:focus{color:#555;background-color:#fff;border:1px solid #ddd;border-bottom-color:transparent;cursor:default}
.nav-pills>li>a{padding-top:8px;padding-bottom:8px;margin-top:2px;margin-bottom:2px;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px}
.nav-pills>.active>a,.nav-pills>.active>a:hover,.nav-pills>.active>a:focus{color:#fff;background-color:#08c}
.nav-stacked>li{float:none}
.nav-stacked>li>a{margin-right:0}
.nav-tabs.nav-stacked{border-bottom:0}
.nav-tabs.nav-stacked>li>a{border:1px solid #ddd;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}
.nav-tabs.nav-stacked>li:first-child>a{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px}
.nav-tabs.nav-stacked>li:last-child>a{-webkit-border-bottom-right-radius:4px;-moz-border-radius-bottomright:4px;border-bottom-right-radius:4px;-webkit-border-bottom-left-radius:4px;-moz-border-radius-bottomleft:4px;border-bottom-left-radius:4px}
.nav-tabs.nav-stacked>li>a:hover,.nav-tabs.nav-stacked>li>a:focus{border-color:#ddd;z-index:2}
.nav-pills.nav-stacked>li>a{margin-bottom:3px}
.nav-pills.nav-stacked>li:last-child>a{margin-bottom:1px}
.nav-tabs .dropdown-menu{-webkit-border-radius:0 0 6px 6px;-moz-border-radius:0 0 6px 6px;border-radius:0 0 6px 6px}
.nav-pills .dropdown-menu{-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px}
.nav .dropdown-toggle .caret{border-top-color:#08c;border-bottom-color:#08c;margin-top:6px}
.nav .dropdown-toggle:hover .caret,.nav .dropdown-toggle:focus .caret{border-top-color:#005580;border-bottom-color:#005580}
.nav-tabs .dropdown-toggle .caret{margin-top:8px}
.nav .active .dropdown-toggle .caret{border-top-color:#fff;border-bottom-color:#fff}
.nav-tabs .active .dropdown-toggle .caret{border-top-color:#555;border-bottom-color:#555}
.nav>.dropdown.active>a:hover,.nav>.dropdown.active>a:focus{cursor:pointer}
.nav-tabs .open .dropdown-toggle,.nav-pills .open .dropdown-toggle,.nav>li.dropdown.open.active>a:hover,.nav>li.dropdown.open.active>a:focus{color:#fff;background-color:#999;border-color:#999}
.nav li.dropdown.open .caret,.nav li.dropdown.open.active .caret,.nav li.dropdown.open a:hover .caret,.nav li.dropdown.open a:focus .caret{border-top-color:#fff;border-bottom-color:#fff;opacity:1;filter:alpha(opacity=100)}
.tabs-stacked .open>a:hover,.tabs-stacked .open>a:focus{border-color:#999}
.tabbable{*zoom:1}
.tabbable:before,.tabbable:after{display:table;content:"";line-height:0}
.tabbable:after{clear:both}
.tab-content{overflow:auto}
.tabs-right>.nav-tabs{float:right;margin-left:19px;border-left:1px solid #ddd}
.tabs-right>.nav-tabs>li>a{margin-left:-1px;-webkit-border-radius:0 4px 4px 0;-moz-border-radius:0 4px 4px 0;border-radius:0 4px 4px 0}
.tabs-right>.nav-tabs>li>a:hover,.tabs-right>.nav-tabs>li>a:focus{border-color:#eee #eee #eee #ddd}
.tabs-right>.nav-tabs .active>a,.tabs-right>.nav-tabs .active>a:hover,.tabs-right>.nav-tabs .active>a:focus{border-color:#ddd #ddd #ddd transparent;*border-left-color:#fff}
.nav>.disabled>a{color:#999}
.nav>.disabled>a:hover,.nav>.disabled>a:focus{text-decoration:none;background-color:transparent;cursor:default}
.jtnavbar{overflow:visible;margin-bottom:20px;*position:relative;*z-index:2}
.jtnavbar-inner{min-height:40px;padding-left:20px;padding-right:20px;background-color:#fafafa;background-image:-moz-linear-gradient(top,#fff,#f2f2f2);background-image:-webkit-gradient(linear,0 0,0 100%,from(#fff),to(#f2f2f2));background-image:-webkit-linear-gradient(top,#fff,#f2f2f2);background-image:-o-linear-gradient(top,#fff,#f2f2f2);background-image:linear-gradient(to bottom,#fff,#f2f2f2);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffff',endColorstr='#fff2f2f2',GradientType=0);border:1px solid #d4d4d4;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:0 1px 4px rgba(0,0,0,0.065);-moz-box-shadow:0 1px 4px rgba(0,0,0,0.065);box-shadow:0 1px 4px rgba(0,0,0,0.065);*zoom:1}
.jtnavbar-inner:before,.jtnavbar-inner:after{display:table;content:"";line-height:0}
.jtnavbar-inner:after{clear:both}
.jtnavbar .jtcontainer{width:auto}
.nav-jtcollapse.jtcollapse{
	/*height:auto;*/
	overflow:visible
}
.jtnavbar .brand{float:left;display:block;padding:10px 20px 10px;margin-left:-20px;font-size:20px;font-weight:200;color:#777;text-shadow:0 1px 0 #fff}
.jtnavbar .brand:hover,.jtnavbar .brand:focus{text-decoration:none}
.jtnavbar-text{margin-bottom:0;line-height:40px;color:#777}
.jtnavbar-link{color:#777}
.jtnavbar-link:hover,.jtnavbar-link:focus{color:#333}
.jtnavbar .divider-vertical{height:40px;margin:0 9px;border-left:1px solid #f2f2f2;border-right:1px solid #fff}
.jtnavbar .btn,.jtnavbar .btn-group{margin-top:5px}
.jtnavbar .btn-group .btn,.jtnavbar .input-prepend .btn,.jtnavbar .input-append .btn,.jtnavbar .input-prepend .btn-group,.jtnavbar .input-append .btn-group{margin-top:0}
.jtnavbar-search{position:relative;float:left;margin-top:5px;margin-bottom:0}
.jtnavbar-search .search-query{margin-bottom:0;padding:4px 14px;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:13px;font-weight:normal;line-height:1;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}
.jtnavbar-static-top{position:static;margin-bottom:0}
.jtnavbar-static-top .jtnavbar-inner{-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}
.jtnavbar-fixed-top,.jtnavbar-fixed-bottom{position:fixed;right:0;left:0;z-index:1030;margin-bottom:0}
.jtnavbar-fixed-top .jtnavbar-inner,.jtnavbar-static-top .jtnavbar-inner{border-width:0 0 1px}
.jtnavbar-fixed-bottom .jtnavbar-inner{border-width:1px 0 0}
.jtnavbar-fixed-top .jtnavbar-inner,.jtnavbar-fixed-bottom .jtnavbar-inner{padding-left:0;padding-right:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0}
.jtnavbar-static-top .jtcontainer,.jtnavbar-fixed-top .jtcontainer,.jtnavbar-fixed-bottom .jtcontainer{width:940px}
.jtnavbar-fixed-top{top:0}
.jtnavbar-fixed-top .jtnavbar-inner,.jtnavbar-static-top .jtnavbar-inner{-webkit-box-shadow:0 1px 10px rgba(0,0,0,.1);-moz-box-shadow:0 1px 10px rgba(0,0,0,.1);box-shadow:0 1px 10px rgba(0,0,0,.1)}
.jtnavbar-fixed-bottom{bottom:0}
.jtnavbar-fixed-bottom .jtnavbar-inner{-webkit-box-shadow:0 -1px 10px rgba(0,0,0,.1);-moz-box-shadow:0 -1px 10px rgba(0,0,0,.1);box-shadow:0 -1px 10px rgba(0,0,0,.1)}
.jtnavbar .nav{position:relative;left:0;display:block;float:left;margin:0 10px 0 0}
.jtnavbar .nav.pull-right{float:right;margin-right:0}
.jtnavbar .nav>li{float:left}
.jtnavbar .nav>li>a{float:none;padding:10px 15px 10px;color:#777;text-decoration:none;text-shadow:0 1px 0 #fff}
.jtnavbar .nav .dropdown-toggle .caret{margin-top:8px}
.jtnavbar .nav>li>a:focus,.jtnavbar .nav>li>a:hover{background-color:transparent;color:#333;text-decoration:none}
.jtnavbar .nav>.active>a,.jtnavbar .nav>.active>a:hover,.jtnavbar .nav>.active>a:focus{color:#555;text-decoration:none;background-color:#e5e5e5;-webkit-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);-moz-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);box-shadow:inset 0 3px 8px rgba(0,0,0,0.125)}
.jtnavbar .btn-jtnavbar{
    display:none;
    float:right;
    padding:7px 10px;
    margin-left:5px;
    margin-right:5px;
    color:#fff;
}
.jtnavbar .nav>li>.dropdown-menu:before{content:'';display:inline-block;border-left:7px solid transparent;border-right:7px solid transparent;border-bottom:7px solid #ccc;border-bottom-color:rgba(0,0,0,0.2);position:absolute;top:-7px;left:9px}
.jtnavbar .nav>li>.dropdown-menu:after{content:'';display:inline-block;border-left:6px solid transparent;border-right:6px solid transparent;border-bottom:6px solid #fff;position:absolute;top:-6px;left:10px}
.jtnavbar-fixed-bottom .nav>li>.dropdown-menu:before{border-top:7px solid #ccc;border-top-color:rgba(0,0,0,0.2);border-bottom:0;bottom:-7px;top:auto}
.jtnavbar-fixed-bottom .nav>li>.dropdown-menu:after{border-top:6px solid #fff;border-bottom:0;bottom:-6px;top:auto}
.jtnavbar .nav li.dropdown>a:hover .caret,.jtnavbar .nav li.dropdown>a:focus .caret{border-top-color:#333;border-bottom-color:#333}
.jtnavbar .nav li.dropdown.open>.dropdown-toggle,.jtnavbar .nav li.dropdown.active>.dropdown-toggle,.jtnavbar .nav li.dropdown.open.active>.dropdown-toggle{background-color:#e5e5e5;color:#555}
.jtnavbar .nav li.dropdown>.dropdown-toggle .caret{border-top-color:#777;border-bottom-color:#777}
.jtnavbar .nav li.dropdown.open>.dropdown-toggle .caret,.jtnavbar .nav li.dropdown.active>.dropdown-toggle .caret,.jtnavbar .nav li.dropdown.open.active>.dropdown-toggle .caret{border-top-color:#555;border-bottom-color:#555}
.jtnavbar .pull-right>li>.dropdown-menu,.jtnavbar .nav>li>.dropdown-menu.pull-right{left:auto;right:0}
.jtnavbar .pull-right>li>.dropdown-menu:before,.jtnavbar .nav>li>.dropdown-menu.pull-right:before{left:auto;right:12px}
.jtnavbar .pull-right>li>.dropdown-menu:after,.jtnavbar .nav>li>.dropdown-menu.pull-right:after{left:auto;right:13px}
.jtnavbar .pull-right>li>.dropdown-menu .dropdown-menu,.jtnavbar .nav>li>.dropdown-menu.pull-right .dropdown-menu{left:auto;right:100%;margin-left:0;margin-right:-1px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px}
.jtnavbar-inverse .jtnavbar-inner{background-color:#1b1b1b;background-image:-moz-linear-gradient(top,#222,#111);background-image:-webkit-gradient(linear,0 0,0 100%,from(#222),to(#111));background-image:-webkit-linear-gradient(top,#222,#111);background-image:-o-linear-gradient(top,#222,#111);background-image:linear-gradient(to bottom,#222,#111);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2222',endColorstr='#f1111',GradientType=0);border-color:#252525}
.jtnavbar-inverse .brand,.jtnavbar-inverse .nav>li>a{color:#999;text-shadow:0 -1px 0 rgba(0,0,0,0.25)}
.jtnavbar-inverse .brand:hover,.jtnavbar-inverse .nav>li>a:hover,.jtnavbar-inverse .brand:focus,.jtnavbar-inverse .nav>li>a:focus{color:#fff}
.jtnavbar-inverse .brand{color:#999}
.jtnavbar-inverse .jtnavbar-text{color:#999}
.jtnavbar-inverse .nav>li>a:focus,.jtnavbar-inverse .nav>li>a:hover{background-color:rgba(255,255,255,0.18);color:#fff}
.jtnavbar-inverse .nav .active>a,.jtnavbar-inverse .nav .active>a:hover,.jtnavbar-inverse .nav .active>a:focus{color:#fff;background-color:#111}
.jtnavbar-inverse .jtnavbar-link{color:#999}
.jtnavbar-inverse .jtnavbar-link:hover,.jtnavbar-inverse .jtnavbar-link:focus{color:#fff}
.jtnavbar-inverse .divider-vertical{border-left-color:#111;border-right-color:#222}
.jtnavbar-inverse .nav li.dropdown.open>.dropdown-toggle,.jtnavbar-inverse .nav li.dropdown.active>.dropdown-toggle,.jtnavbar-inverse .nav li.dropdown.open.active>.dropdown-toggle{background-color:#111;color:#fff}
.jtnavbar-inverse .nav li.dropdown>a:hover .caret,.jtnavbar-inverse .nav li.dropdown>a:focus .caret{border-top-color:#fff;border-bottom-color:#fff}
.jtnavbar-inverse .nav li.dropdown>.dropdown-toggle .caret{border-top-color:#999;border-bottom-color:#999}
.jtnavbar-inverse .nav li.dropdown.open>.dropdown-toggle .caret,.jtnavbar-inverse .nav li.dropdown.active>.dropdown-toggle .caret,.jtnavbar-inverse .nav li.dropdown.open.active>.dropdown-toggle .caret{border-top-color:#fff;border-bottom-color:#fff}
.dropup,.dropdown{position:relative}
.dropdown-toggle{*margin-bottom:-3px}
.dropdown-toggle:active,.open .dropdown-toggle{outline:0}
.caret{display:inline-block;width:0;height:0;vertical-align:top;border-top:4px solid #000;border-right:4px solid transparent;border-left:4px solid transparent;content:""}
.dropdown .caret{margin-top:8px;margin-left:2px}
.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:160px;padding:5px 0;margin:2px 0 0;list-style:none;background-color:#fff;border:1px solid #ccc;border:1px solid rgba(0,0,0,0.2);*border-right-width:2px;*border-bottom-width:2px;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);box-shadow:0 5px 10px rgba(0,0,0,0.2);-webkit-background-clip:padding-box;-moz-background-clip:padding;background-clip:padding-box}
.dropdown-menu.pull-right{right:0;left:auto}
.dropdown-menu .divider{*width:100%;height:1px;margin:9px 1px;*margin:-5px 0 5px;overflow:hidden;background-color:#e5e5e5;border-bottom:1px solid #fff}
.dropdown-menu>li>a{display:block;padding:3px 20px;clear:both;font-weight:normal;line-height:20px;color:#333;white-space:nowrap}
.dropdown-menu>li>a:hover,.dropdown-menu>li>a:focus,.dropdown-submenu:hover>a,.dropdown-submenu:focus>a{text-decoration:none;color:#fff;background-color:#0081c2;background-image:-moz-linear-gradient(top,#08c,#0077b3);background-image:-webkit-gradient(linear,0 0,0 100%,from(#08c),to(#0077b3));background-image:-webkit-linear-gradient(top,#08c,#0077b3);background-image:-o-linear-gradient(top,#08c,#0077b3);background-image:linear-gradient(to bottom,#08c,#0077b3);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f08cc',endColorstr='#f07b3',GradientType=0)}
.dropdown-menu>.active>a,.dropdown-menu>.active>a:hover,.dropdown-menu>.active>a:focus{color:#fff;text-decoration:none;outline:0;background-color:#0081c2;background-image:-moz-linear-gradient(top,#08c,#0077b3);background-image:-webkit-gradient(linear,0 0,0 100%,from(#08c),to(#0077b3));background-image:-webkit-linear-gradient(top,#08c,#0077b3);background-image:-o-linear-gradient(top,#08c,#0077b3);background-image:linear-gradient(to bottom,#08c,#0077b3);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f08cc',endColorstr='#f07b3',GradientType=0)}
.dropdown-menu>.disabled>a,.dropdown-menu>.disabled>a:hover,.dropdown-menu>.disabled>a:focus{color:#999}
.dropdown-menu>.disabled>a:hover,.dropdown-menu>.disabled>a:focus{text-decoration:none;background-color:transparent;background-image:none;filter:progid:DXImageTransform.Microsoft.gradient(enabled = false);cursor:default}
.open{*z-index:1000}
.open>.dropdown-menu{display:block}
.dropdown-backdrop{position:fixed;left:0;right:0;bottom:0;top:0;z-index:990}
.pull-right>.dropdown-menu{right:0;left:auto}
.dropup .caret,.jtnavbar-fixed-bottom .dropdown .caret{border-top:0;border-bottom:4px solid #000;content:""}
.dropup .dropdown-menu,.jtnavbar-fixed-bottom .dropdown .dropdown-menu{top:auto;bottom:100%;margin-bottom:1px}
.dropdown-submenu{position:relative}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px}
.dropdown-submenu:hover>.dropdown-menu{display:block}
.dropup .dropdown-submenu>.dropdown-menu{top:auto;bottom:0;margin-top:0;margin-bottom:-2px;-webkit-border-radius:5px 5px 5px 0;-moz-border-radius:5px 5px 5px 0;border-radius:5px 5px 5px 0}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;border-left-color:#ccc;margin-top:5px;margin-right:-10px}
.dropdown-submenu:hover>a:after{border-left-color:#fff}
.dropdown-submenu.pull-left{float:none}
.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px}
.typeahead{z-index:1051;margin-top:2px;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.accordion{margin-bottom:20px}
.accordion-group{margin-bottom:2px;border:1px solid #e5e5e5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.accordion-heading{border-bottom:0}
.accordion-heading .accordion-toggle{display:block;padding:8px 15px}
.accordion-toggle{cursor:pointer}
.accordion-inner{padding:9px 15px;border-top:1px solid #e5e5e5}
.close{float:right;font-size:20px;font-weight:bold;line-height:20px;color:#000;text-shadow:0 1px 0 #fff;opacity:0.2;filter:alpha(opacity=20)}
.close:hover,.close:focus{color:#000;text-decoration:none;cursor:pointer;opacity:0.4;filter:alpha(opacity=40)}
button.close{padding:0;cursor:pointer;background:transparent;border:0;-webkit-appearance:none}
.pull-right{float:right}
.pull-left{float:left}
.hide{display:none}
.show{display:block}
.invisible{visibility:hidden}
.affix{position:fixed}
.fade{opacity:0;-webkit-transition:opacity 0.15s linear;-moz-transition:opacity 0.15s linear;-o-transition:opacity 0.15s linear;transition:opacity 0.15s linear}
.fade.in{opacity:1}
.jtcollapse{position:relative;height:0;overflow:hidden;-webkit-transition:height 0.35s ease;-moz-transition:height 0.35s ease;-o-transition:height 0.35s ease;transition:height 0.35s ease}
.jtcollapse.in{height:auto}
@-ms-viewport{width:device-width}
.hidden{display:none;visibility:hidden}
.visible-phone{display:none !important}
.visible-tablet{display:none !important}
.hidden-desktop{display:none !important}
.visible-desktop{display:inherit !important}
#searchform label, #searchform input[type="submit"]{display: none;}
#side-bar #searchform input[type="submit"]{display: inline-block;width: 28%;}
#masthead .bl_search {float: right;margin: 5px 0;}
#masthead .bl_search form{margin: 0;}
#masthead #searchform input[type="text"]{border:none;-moz-border-radius:2px;-webkit-border-radius:2px;border-radius:2px;width:100%;margin:0;background:#636E7C;color:#A0A0A0;-webkit-transition:background 0.2s ease-in-out;-moz-transition:background 0.2s ease-in-out;-o-transition:background 0.2s ease-in-out;-ms-transition:background 0.2s ease-in-out;transition:background 0.2s ease-in-out}
#searchform input[type="text"]:focus{background:#fafafa;color:#444;box-shadow:none}
.jtnavbar-inverse .jtnavbar-inner{background:transparent;-moz-border-radius:0;-webkit-border-radius:0;border-radius:0;-moz-box-shadow:none;-webkit-box-shadow:none;box-shadow:none;border:none;padding:0 15px;filter:none}
.jtnavbar{margin-bottom:0}
.jtnavbar .brand{color:#FFF;height:70px;margin:0 30px 0 0;padding:13px 0 12px}
.jtnavbar .brand-text{line-height:42px}
.jtnavbar .brand img{height:45px}
.jtnavbar .nav > li > a{color:#EFEFEF;display:block;font-size:16px;font-weight:300;line-height:25px;padding:23px 20px 20px;text-decoration:none;-webkit-transition:all 0.1s ease-in-out;-moz-transition:all 0.1s ease-in-out;-o-transition:all 0.1s ease-in-out;-ms-transition:all 0.1s ease-in-out;transition:all 0.1s ease-in-out}
.jtnavbar a.brand p{font-size:12px;line-height:0;margin:0;opacity:0.8}
.jtnavbar a.brand.brand-tagline{padding:5px 0 0}
.jtnavbar .nav > li > a:focus + ul{display:block}
.jtnavbar-inverse .brand,.jtnavbar-inverse .nav > li > a{text-shadow:none}
.jtnavbar-inverse .nav-jtcollapse .nav > li > a,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a{color:#EFEFEF}
.jtnavbar .nav > li.active,.jtnavbar .nav > li:hover{background:none repeat scroll 0 0 rgba(255,255,255,0.02);color:#fff}
.dropdown-menu{background:none repeat scroll 0 0 #212833;border-top:2px solid #F69087;border-left:0;border-right:0;border-radius:0;padding:0;margin:0}
.dropdown-menu > li > a{color:#FFF;font-size:16px;padding:15px 20px}
.jtnavbar .nav > li > .dropdown-menu:after,.jtnavbar .nav > li > .dropdown-menu:before{display:none}
.jtnavbar .nav > li:hover > ul{display:block}
.dropdown-menu > li > a:hover{background:#38404B}
.jtnavbar-inverse .nav li.dropdown.open > .dropdown-toggle,.jtnavbar-inverse .nav li.dropdown.active > .dropdown-toggle,.jtnavbar-inverse .nav li.dropdown.open.active > .dropdown-toggle{background:none repeat scroll 0 0 #212833}
.dropdown-toggle i{font-size:12px;margin:0 0 0 4px}
.jtnavbar .btn-jtnavbar{
    cursor:pointer;
    margin:18px 15px 18px 0;
    padding:0px 10px;
    display:block;
    -webkit-appearance:inherit;
}
.nav-jtcollapse .nav > li > a,.nav-jtcollapse .dropdown-menu a{-moz-border-radius:0;-webkit-border-radius:0;border-radius:0}
#masthead{height:75px;background:#2E3641;margin-bottom:50px;left:0;position:fixed;top:0;width:100%;z-index:999}
#page{position:relative}
.top-color div{float:left;height:5px;width:25%}
.jtcontainer{margin-right:auto;margin-left:auto;*zoom:1}
.jtcontainer:before,.jtcontainer:after{display:table;content:"";line-height:0}
.jtcontainer:after{clear:both}
#header{
    /* margin-right:30px; */
    float:left
}
#header,#header a{color:#FFF}
#header img{margin-top:13px;width:auto;max-height:60px}

@media (max-width:979px) {
    body {
        padding-top: 0;
    }

    .jtnavbar-fixed-top,.jtnavbar-fixed-bottom {
        position: static;
    }

    .jtnavbar-fixed-top {
        margin-bottom: 20px;
    }

    .jtnavbar-fixed-bottom {
        margin-top: 20px;
    }

    .jtnavbar-fixed-top .jtnavbar-inner,
    .jtnavbar-fixed-bottom .jtnavbar-inner {
        padding: 5px;
    }

    .jtnavbar .jtcontainer {
        width: auto;
        padding: 0;
    }

    .jtnavbar .brand {
        padding-left: 20px;
        padding-right: 20px;
        margin: 0 0 0 -5px;
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

    .nav-jtcollapse .nav>.divider-vertical {
        display: none;
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

    .nav-jtcollapse .btn {
        padding: 4px 10px 4px;
        font-weight: normal;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
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

    .nav-jtcollapse.in .btn-group {
        margin-top: 5px;
        padding: 0;
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

    .nav-jtcollapse .dropdown-menu .divider {
        display: none;
    }
.nav-jtcollapse .nav>li>.dropdown-menu:before,.nav-jtcollapse .nav>li>.dropdown-menu:after{display:none;}
.nav-jtcollapse .jtnavbar .nav-jtcollapse .nav.pull-right{float:none;margin-left:0;} 

.nav-jtcollapse,.nav-jtcollapse.jtcollapse{
	overflow:hidden;
	/*height:0;*/
} 

.jtnavbar-static .jtnavbar-inner{padding-left:10px;padding-right:10px;}}@media (min-width:980px){.nav-jtcollapse.jtcollapse{height:auto !important;overflow:visible !important;}}
@media (min-width: 1200px) {
    .span9{width:840px}
    .share-story-jtcontainer small{margin:19px;position:static}
    .share-story{margin:13px 0 0}
}
@media (min-width: 768px) and (max-width: 979px) {
    #primary,.site-footer .jtcontainer{padding-left:20px;padding-right:20px}
    #masthead{position:fixed}
    .jtcontainer{width:auto}
    [class*="span"],.uneditable-input[class*="span"],.row-fluid [class*="span"]{-moz-box-sizing:border-box;display:block;float:none;margin-left:0;width:100%}
    .row{margin-left:0}
    #side-bar{margin:0;width:100%}
    #side-bar .bl_tweets #tweets iframe{min-width:100%!important}
    #masthead .bl_search{float:none;margin:0}
    #masthead .bl_search.jtcollapse.in{margin:20px 15px}
    .jtnavbar-inverse .jtnavbar-inner{padding:0;background:0 0 #2E3641}
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus{background:transparent;color:#F69087}
    .jtnavbar .nav > li > a{border-left:3px solid transparent}
    .jtnavbar .nav > li > a:hover,.jtnavbar .nav > li > a:active,.jtnavbar .nav > li > a:focus{border-left:3px solid #85CCB1}
    .jtnavbar-inverse .nav-jtcollapse .nav > li > a:hover,.jtnavbar-inverse .nav-jtcollapse .nav > li > a:focus,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus{background:transparent}
    .nav-jtcollapse .nav > li > a,.nav-jtcollapse .dropdown-menu a{font-weight:normal;padding:12px 15px;margin:0}
    .nav-jtcollapse .open > .dropdown-menu{background:#212833;margin:0}
    #footer-body > [class*="span"]{margin-bottom:20px}
}
@media (max-width: 767px) {
    #primary,.site-footer .jtcontainer{padding-left:20px;padding-right:20px}
    #masthead{position:fixed}
    .jtcontainer{width:auto}
    #masthead .bl_search{float:none;margin:0}
    #masthead .bl_search.jtcollapse.in{margin:15px}
    .jtnavbar .brand{margin:0}
    .jtnavbar-inner{padding:0}
    .nav-jtcollapse .nav{margin-bottom:0}
    .jtnavbar .nav > li > a{border-left:3px solid transparent}
    .jtnavbar .nav > li > a:hover,.jtnavbar .nav > li > a:active,.jtnavbar .nav > li > a:focus{border-left:3px solid #85CCB1}
    .nav-jtcollapse .dropdown-menu{background:#38404B;margin:0}
    .jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus{background:transparent;color:#F69087}
    .jtnavbar-inverse .jtnavbar-inner{padding:0}
    .jtnavbar-inverse .jtnavbar-inner{background:#2E3641}
    .jtnavbar-inverse .nav-jtcollapse .nav > li > a:hover,.jtnavbar-inverse .nav-jtcollapse .nav > li > a:focus,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus{background:transparent}
    .nav-jtcollapse .nav > li > a,.nav-jtcollapse .dropdown-menu a{font-weight:normal;padding:12px 15px;margin:0}
    .nav-jtcollapse .open > .dropdown-menu{background:#212833;margin:0}
}
@media (max-width: 480px) {
    #primary{padding-left:5px;padding-right:5px}
    .jtnavbar .brand{padding-left:5px;padding-right:5px}
    .bl_background{display:none}
}
.top-color-clearfix {
    position: fixed;
    top: 0px;
    width: 100%;
    min-height: 5px;
    display:block;
}
.clearfix {
    *zoom:1
}

.clearfix:before,.clearfix:after {
    display: table;
    content: "";
    line-height: 0
}

.clearfix:after {
    clear: both
}

.top-color-clearfix div {
    float:left;
    height: 8px;
    width: 25%;
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
    margin-top: 16px
}
</style>

<div id='masthead' role='banner' class="mainNavContainerWrapper">
  <div class='top-color clearfix'>
	<div style='background: none repeat scroll 0% 0% #F69087;'></div>
	<div style='background: none repeat scroll 0% 0% #85CCB1;'></div>
	<div style='background: none repeat scroll 0% 0% #85A9B3;'></div>
	<div style='background: none repeat scroll 0% 0% #B0CB7A;'></div>
  </div>
  <div class='jtcontainer' id='mainNavContainer'>
	<div class='jtnavbar jtnavbar-inverse'>
	  <div class='jtnavbar-inner'>
		<div class='btn-jtnavbar jtcollapsed' data-target='.nav-jtcollapse' data-toggle='jtcollapse' type='button'>
		  <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAjCAMAAADR57icAAAAdVBMVEWFzLGFzLGQ0bgAAACFzLGJxa99uKNjiYGR0bmGzbKDyK55t6KJxK9zrJljj4WDxq2Exa1ol4poloqFzLGGzbL6/v32+PiIyrFuoo6DzLCNz7aAyKxwo5Cr1buK0raDzLaAy6/3+Pjd9vb29vTa8PB+xK52qpLUNYl7AAAAE3RSTlPMgc8A9cV3EM/Ou5l2LSnHxz093oLWngAAAJNJREFUOMvt0rcSwkAMRVGBNjgTVoQliMz/fyIVRjMetFu68KnvjF4hQN/YYq4qbOMRvGUKpArE1oPjGJIiO1hSyEALKEOWEiAvhPGEJKjhUVDD9/7Ue9HfMF6e26/b43xVwvvmZxBKOyGxsTdtHJ4+COrGKIz1w8cZ1pzTcQ2doXRHpgNcVSbVmWqNgNi6WYJrET8q82NhjDxGFQAAAABJRU5ErkJggg==' />
		</div>
		<div class='header' id='header'>
		  <div class='widget Header' data-version='1' id='Header1'>
			<div id='header-inner'>
			  <div class='titlewrapper'>
				<h1 class='title'>
				  <a href='/'>Joshuatz.com</a>
				</h1>
			  </div>
			  <div class='descriptionwrapper'>
				<p class='description'></p>
			  </div>
			</div>
		  </div>
		</div>
		<div class='nav-jtcollapse jtcollapse'>
		  <ul class='nav' id='menu-primary'>
            <?php if(!is_front_page()): ?>
			<li>
			  <a href='/'>Home</a>
            </li>
            <?php endif; ?>
			<li>
			  <a href="https://www.linkedin.com/in/joshuatzucker" target="_blank" id="linkedIn">About / <i class="fa fa-linkedin-square" style="font-size:large"></i>
				</a>
			</li>
			<li class='dropdown'>
			  <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Projects</a>
			  <ul class='dropdown-menu'>
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
			<li>
			  <a href='mailto:joshuatz.com@gmail.com' ga-on="click,auxclick,contextmenu", ga-event-category="Social" ga-event-label="Email">Contact</a>
			</li>
		  </ul>
		</div>
        <div id="nav-search-wrapper">
            <div class='bl_search nav-jtcollapse jtcollapse'>
                <script>
                    (function() {
                        var cx = '006023929046275200110:crr5g9pbyae';
                        var gcse = document.createElement('script');
                        gcse.type = 'text/javascript';
                        gcse.async = true;
                        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(gcse, s);
                    })();
                </script>
                <style>
                    .gsc-control-cse.gsc-control-cse-en {
                        border-color: transparent !Important;
                        background-color: transparent !Important;
                    }
                    form.gsc-search-box > table {
                        border-collapse: separate;
                    }
                    .cse .gsc-control-cse, .gsc-control-cse {
                        padding: 1px;
                    }
                </style>
                <gcse:search></gcse:search>
            </div>
        </div>
        <div class="fullHeightEnd" style="height:100%; width:1px;"></div>
	  </div>
	</div>
  </div>
  <div class='clear'></div>
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
        #masthead .titlewrapper h1.title {
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
    }

    /* If width is LARGER than breakpoint */
    @media (min-width: <?php echo $navBreakpointPx; ?>){
        #masthead .titlewrapper h1.title {
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
        offsetNavFromAdminBar();
        function offsetMainFromTop(){
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
            var newOffset = mainNavHeight + topColorBarHeight + mastheadTop - wpAdminBarHeight;
            /*
            console.group('height report');
                console.log('topColorBarHeight = ' + topColorBarHeight);
                console.log('mainNavHeight = ' + mainNavHeight);
                console.log('innermostNavHeight = ' + innermostNavHeight);
                console.log('mastheadTop = ' + mastheadTop);
                console.log('wpAdminBarHeight = ' + wpAdminBarHeight);
                console.log('newOffset = ' + newOffset);
            console.groupEnd();
            */
            $('#main').css({
                'padding-top' : newOffset + 'px'
            });
        }
        offsetMainFromTop();
        // Since nav bar is fixed, on resize need to get new height and offset main (which is not fixed) by height
        $(window).on('resize',function(){
            // offset should be nav height + top-color-bar height + masthead top offset
            offsetNavFromAdminBar();
            setTimeout(function(){
                offsetMainFromTop();
            },10);
        });
    });
})(jQuery)
</script>