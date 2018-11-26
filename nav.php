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
.nav-header{display:block;padding:3px 15px;font-size:11px;font-weight:bold;line-height:20px;color:#999;text-shadow:0 1px 0 rgba(255,255,255,0.5);text-transform:uppercase}
.nav li+.nav-header{margin-top:9px}
.nav-list{padding-left:15px;padding-right:15px;margin-bottom:0}
.nav-list>li>a,.nav-list .nav-header{margin-left:-15px;margin-right:-15px;text-shadow:0 1px 0 rgba(255,255,255,0.5)}
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
.tabs-below>.nav-tabs,.tabs-right>.nav-tabs,.tabs-left>.nav-tabs{border-bottom:0}
.tab-content>.tab-pane,.pill-content>.pill-pane{display:none}
.tab-content>.active,.pill-content>.active{display:block}
.tabs-below>.nav-tabs{border-top:1px solid #ddd}
.tabs-below>.nav-tabs>li{margin-top:-1px;margin-bottom:0}
.tabs-below>.nav-tabs>li>a{-webkit-border-radius:0 0 4px 4px;-moz-border-radius:0 0 4px 4px;border-radius:0 0 4px 4px}
.tabs-below>.nav-tabs>li>a:hover,.tabs-below>.nav-tabs>li>a:focus{border-bottom-color:transparent;border-top-color:#ddd}
.tabs-below>.nav-tabs>.active>a,.tabs-below>.nav-tabs>.active>a:hover,.tabs-below>.nav-tabs>.active>a:focus{border-color:transparent #ddd #ddd #ddd}
.tabs-left>.nav-tabs>li,.tabs-right>.nav-tabs>li{float:none}
.tabs-left>.nav-tabs>li>a,.tabs-right>.nav-tabs>li>a{min-width:74px;margin-right:0;margin-bottom:3px}
.tabs-left>.nav-tabs{float:left;margin-right:19px;border-right:1px solid #ddd}
.tabs-left>.nav-tabs>li>a{margin-right:-1px;-webkit-border-radius:4px 0 0 4px;-moz-border-radius:4px 0 0 4px;border-radius:4px 0 0 4px}
.tabs-left>.nav-tabs>li>a:hover,.tabs-left>.nav-tabs>li>a:focus{border-color:#eee #ddd #eee #eee}
.tabs-left>.nav-tabs .active>a,.tabs-left>.nav-tabs .active>a:hover,.tabs-left>.nav-tabs .active>a:focus{border-color:#ddd transparent #ddd #ddd;*border-right-color:#fff}
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
.jtnavbar-form{margin-bottom:0;*zoom:1}
.jtnavbar-form:before,.jtnavbar-form:after{display:table;content:"";line-height:0}
.jtnavbar-form:after{clear:both}
.jtnavbar-form input,.jtnavbar-form select,.jtnavbar-form .radio,.jtnavbar-form .checkbox{margin-top:5px}
.jtnavbar-form input,.jtnavbar-form select,.jtnavbar-form .btn{display:inline-block;margin-bottom:0}
.jtnavbar-form input[type="image"],.jtnavbar-form input[type="checkbox"],.jtnavbar-form input[type="radio"]{margin-top:3px}
.jtnavbar-form .input-append,.jtnavbar-form .input-prepend{margin-top:5px;white-space:nowrap}
.jtnavbar-form .input-append input,.jtnavbar-form .input-prepend input{margin-top:0}
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
.jtnavbar .btn-jtnavbar{display:none;float:right;padding:7px 10px;margin-left:5px;margin-right:5px;color:#fff;}
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
.jtnavbar-inverse .jtnavbar-search .search-query{color:#fff;background-color:#515151;border-color:#111;-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.1),0 1px 0 rgba(255,255,255,.15);-moz-box-shadow:inset 0 1px 2px rgba(0,0,0,.1),0 1px 0 rgba(255,255,255,.15);box-shadow:inset 0 1px 2px rgba(0,0,0,.1),0 1px 0 rgba(255,255,255,.15);-webkit-transition:none;-moz-transition:none;-o-transition:none;transition:none}
.jtnavbar-inverse .jtnavbar-search .search-query:-moz-placeholder{color:#ccc}
.jtnavbar-inverse .jtnavbar-search .search-query:-ms-input-placeholder{color:#ccc}
.jtnavbar-inverse .jtnavbar-search .search-query::-webkit-input-placeholder{color:#ccc}
.jtnavbar-inverse .jtnavbar-search .search-query:focus,.jtnavbar-inverse .jtnavbar-search .search-query.focused{padding:5px 15px;color:#333;text-shadow:0 1px 0 #fff;background-color:#fff;border:0;-webkit-box-shadow:0 0 3px rgba(0,0,0,0.15);-moz-box-shadow:0 0 3px rgba(0,0,0,0.15);box-shadow:0 0 3px rgba(0,0,0,0.15);outline:0}
.breadcrumb{padding:8px 15px;margin:0 0 20px;list-style:none;background-color:#f5f5f5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.breadcrumb>li{display:inline-block;*display:inline;*zoom:1;text-shadow:0 1px 0 #fff}
.breadcrumb>li>.divider{padding:0 5px;color:#ccc}
.breadcrumb>.active{color:#999}
.pagination{margin:20px 0}
.pagination ul{display:inline-block;*display:inline;*zoom:1;margin-left:0;margin-bottom:0;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:0 1px 2px rgba(0,0,0,0.05);-moz-box-shadow:0 1px 2px rgba(0,0,0,0.05);box-shadow:0 1px 2px rgba(0,0,0,0.05)}
.pagination ul>li{display:inline}
.pagination ul>li>a,.pagination ul>li>span{float:left;padding:4px 12px;line-height:20px;text-decoration:none;background-color:#fff;border:1px solid #ddd;border-left-width:0}
.pagination ul>li>a:hover,.pagination ul>li>a:focus,.pagination ul>.active>a,.pagination ul>.active>span{background-color:#f5f5f5}
.pagination ul>.active>a,.pagination ul>.active>span{color:#999;cursor:default}
.pagination ul>.disabled>span,.pagination ul>.disabled>a,.pagination ul>.disabled>a:hover,.pagination ul>.disabled>a:focus{color:#999;background-color:transparent;cursor:default}
.pagination ul>li:first-child>a,.pagination ul>li:first-child>span{border-left-width:1px;-webkit-border-top-left-radius:4px;-moz-border-radius-topleft:4px;border-top-left-radius:4px;-webkit-border-bottom-left-radius:4px;-moz-border-radius-bottomleft:4px;border-bottom-left-radius:4px}
.pagination ul>li:last-child>a,.pagination ul>li:last-child>span{-webkit-border-top-right-radius:4px;-moz-border-radius-topright:4px;border-top-right-radius:4px;-webkit-border-bottom-right-radius:4px;-moz-border-radius-bottomright:4px;border-bottom-right-radius:4px}
.pagination-centered{text-align:center}
.pagination-right{text-align:right}
.pagination-large ul>li>a,.pagination-large ul>li>span{padding:11px 19px;font-size:17.5px}
.pagination-large ul>li:first-child>a,.pagination-large ul>li:first-child>span{-webkit-border-top-left-radius:6px;-moz-border-radius-topleft:6px;border-top-left-radius:6px;-webkit-border-bottom-left-radius:6px;-moz-border-radius-bottomleft:6px;border-bottom-left-radius:6px}
.pagination-large ul>li:last-child>a,.pagination-large ul>li:last-child>span{-webkit-border-top-right-radius:6px;-moz-border-radius-topright:6px;border-top-right-radius:6px;-webkit-border-bottom-right-radius:6px;-moz-border-radius-bottomright:6px;border-bottom-right-radius:6px}
.pagination-mini ul>li:first-child>a,.pagination-small ul>li:first-child>a,.pagination-mini ul>li:first-child>span,.pagination-small ul>li:first-child>span{-webkit-border-top-left-radius:3px;-moz-border-radius-topleft:3px;border-top-left-radius:3px;-webkit-border-bottom-left-radius:3px;-moz-border-radius-bottomleft:3px;border-bottom-left-radius:3px}
.pagination-mini ul>li:last-child>a,.pagination-small ul>li:last-child>a,.pagination-mini ul>li:last-child>span,.pagination-small ul>li:last-child>span{-webkit-border-top-right-radius:3px;-moz-border-radius-topright:3px;border-top-right-radius:3px;-webkit-border-bottom-right-radius:3px;-moz-border-radius-bottomright:3px;border-bottom-right-radius:3px}
.pagination-small ul>li>a,.pagination-small ul>li>span{padding:2px 10px;font-size:11.9px}
.pagination-mini ul>li>a,.pagination-mini ul>li>span{padding:0 6px;font-size:10.5px}
.pager{margin:20px 0;list-style:none;text-align:center;*zoom:1}
.pager:before,.pager:after{display:table;content:"";line-height:0}
.pager:after{clear:both}
.pager li{display:inline}
.pager li>a,.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;-webkit-border-radius:15px;-moz-border-radius:15px;border-radius:15px}
.pager li>a:hover,.pager li>a:focus{text-decoration:none;background-color:#f5f5f5}
.pager .next>a,.pager .next>span{float:right}
.pager .previous>a,.pager .previous>span{float:left}
.pager .disabled>a,.pager .disabled>a:hover,.pager .disabled>a:focus,.pager .disabled>span{color:#999;background-color:#fff;cursor:default}
.thumbnails{margin-left:-20px;list-style:none;*zoom:1}
.thumbnails:before,.thumbnails:after{display:table;content:"";line-height:0}
.thumbnails:after{clear:both}
.row-fluid .thumbnails{margin-left:0}
.thumbnails>li{float:left;margin-bottom:20px;margin-left:20px}
.thumbnail{display:block;padding:4px;line-height:20px;border:1px solid #ddd;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,0.055);-moz-box-shadow:0 1px 3px rgba(0,0,0,0.055);box-shadow:0 1px 3px rgba(0,0,0,0.055);-webkit-transition:all 0.2s ease-in-out;-moz-transition:all 0.2s ease-in-out;-o-transition:all 0.2s ease-in-out;transition:all 0.2s ease-in-out}
a.thumbnail:hover,a.thumbnail:focus{border-color:#08c;-webkit-box-shadow:0 1px 4px rgba(0,105,214,0.25);-moz-box-shadow:0 1px 4px rgba(0,105,214,0.25);box-shadow:0 1px 4px rgba(0,105,214,0.25)}
.thumbnail>img{display:block;max-width:100%;margin-left:auto;margin-right:auto}
.thumbnail .caption{padding:9px;color:#555}
.alert{padding:8px 35px 8px 14px;margin-bottom:20px;text-shadow:0 1px 0 rgba(255,255,255,0.5);background-color:#fcf8e3;border:1px solid #fbeed5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.alert,.alert h4{color:#c09853}
.alert h4{margin:0}
.alert .close{position:relative;top:-2px;right:-21px;line-height:20px}
.alert-success{background-color:#dff0d8;border-color:#d6e9c6;color:#468847}
.alert-success h4{color:#468847}
.alert-danger,.alert-error{background-color:#f2dede;border-color:#eed3d7;color:#b94a48}
.alert-danger h4,.alert-error h4{color:#b94a48}
.alert-info{background-color:#d9edf7;border-color:#bce8f1;color:#3a87ad}
.alert-info h4{color:#3a87ad}
.alert-block{padding-top:14px;padding-bottom:14px}
.alert-block>p,.alert-block>ul{margin-bottom:0}
.alert-block p+p{margin-top:5px}
@-webkit-keyframes progress-bar-stripes{from{background-position:40px 0}
to{background-position:0 0}
}
@-moz-keyframes progress-bar-stripes{from{background-position:40px 0}
to{background-position:0 0}
}
@-ms-keyframes progress-bar-stripes{from{background-position:40px 0}
to{background-position:0 0}
}
@-o-keyframes progress-bar-stripes{from{background-position:0 0}
to{background-position:40px 0}
}
@keyframes progress-bar-stripes{from{background-position:40px 0}
to{background-position:0 0}
}
.progress{overflow:hidden;height:20px;margin-bottom:20px;background-color:#f7f7f7;background-image:-moz-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-webkit-gradient(linear,0 0,0 100%,from(#f5f5f5),to(#f9f9f9));background-image:-webkit-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:-o-linear-gradient(top,#f5f5f5,#f9f9f9);background-image:linear-gradient(to bottom,#f5f5f5,#f9f9f9);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fff5f5f5',endColorstr='#fff9f9f9',GradientType=0);-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,0.1);-moz-box-shadow:inset 0 1px 2px rgba(0,0,0,0.1);box-shadow:inset 0 1px 2px rgba(0,0,0,0.1);-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.progress .bar{width:0%;height:100%;color:#fff;float:left;font-size:12px;text-align:center;text-shadow:0 -1px 0 rgba(0,0,0,0.25);background-color:#0e90d2;background-image:-moz-linear-gradient(top,#149bdf,#0480be);background-image:-webkit-gradient(linear,0 0,0 100%,from(#149bdf),to(#0480be));background-image:-webkit-linear-gradient(top,#149bdf,#0480be);background-image:-o-linear-gradient(top,#149bdf,#0480be);background-image:linear-gradient(to bottom,#149bdf,#0480be);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff149bdf',endColorstr='#ff0480be',GradientType=0);-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);-moz-box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);box-shadow:inset 0 -1px 0 rgba(0,0,0,0.15);-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;-webkit-transition:width 0.6s ease;-moz-transition:width 0.6s ease;-o-transition:width 0.6s ease;transition:width 0.6s ease}
.progress .bar+.bar{-webkit-box-shadow:inset 1px 0 0 rgba(0,0,0,.15),inset 0 -1px 0 rgba(0,0,0,.15);-moz-box-shadow:inset 1px 0 0 rgba(0,0,0,.15),inset 0 -1px 0 rgba(0,0,0,.15);box-shadow:inset 1px 0 0 rgba(0,0,0,.15),inset 0 -1px 0 rgba(0,0,0,.15)}
.progress-striped .bar{background-color:#149bdf;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);-webkit-background-size:40px 40px;-moz-background-size:40px 40px;-o-background-size:40px 40px;background-size:40px 40px}
.progress.active .bar{-webkit-animation:progress-bar-stripes 2s linear infinite;-moz-animation:progress-bar-stripes 2s linear infinite;-ms-animation:progress-bar-stripes 2s linear infinite;-o-animation:progress-bar-stripes 2s linear infinite;animation:progress-bar-stripes 2s linear infinite}
.progress-danger .bar,.progress .bar-danger{background-color:#dd514c;background-image:-moz-linear-gradient(top,#ee5f5b,#c43c35);background-image:-webkit-gradient(linear,0 0,0 100%,from(#ee5f5b),to(#c43c35));background-image:-webkit-linear-gradient(top,#ee5f5b,#c43c35);background-image:-o-linear-gradient(top,#ee5f5b,#c43c35);background-image:linear-gradient(to bottom,#ee5f5b,#c43c35);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffee5f5b',endColorstr='#ffc43c35',GradientType=0)}
.progress-danger.progress-striped .bar,.progress-striped .bar-danger{background-color:#ee5f5b;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}
.progress-success .bar,.progress .bar-success{background-color:#5eb95e;background-image:-moz-linear-gradient(top,#62c462,#57a957);background-image:-webkit-gradient(linear,0 0,0 100%,from(#62c462),to(#57a957));background-image:-webkit-linear-gradient(top,#62c462,#57a957);background-image:-o-linear-gradient(top,#62c462,#57a957);background-image:linear-gradient(to bottom,#62c462,#57a957);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff62c462',endColorstr='#ff57a957',GradientType=0)}
.progress-success.progress-striped .bar,.progress-striped .bar-success{background-color:#62c462;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}
.progress-info .bar,.progress .bar-info{background-color:#4bb1cf;background-image:-moz-linear-gradient(top,#5bc0de,#339bb9);background-image:-webkit-gradient(linear,0 0,0 100%,from(#5bc0de),to(#339bb9));background-image:-webkit-linear-gradient(top,#5bc0de,#339bb9);background-image:-o-linear-gradient(top,#5bc0de,#339bb9);background-image:linear-gradient(to bottom,#5bc0de,#339bb9);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de',endColorstr='#ff339bb9',GradientType=0)}
.progress-info.progress-striped .bar,.progress-striped .bar-info{background-color:#5bc0de;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}
.progress-warning .bar,.progress .bar-warning{background-color:#faa732;background-image:-moz-linear-gradient(top,#fbb450,#f89406);background-image:-webkit-gradient(linear,0 0,0 100%,from(#fbb450),to(#f89406));background-image:-webkit-linear-gradient(top,#fbb450,#f89406);background-image:-o-linear-gradient(top,#fbb450,#f89406);background-image:linear-gradient(to bottom,#fbb450,#f89406);background-repeat:repeat-x;filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fffbb450',endColorstr='#fff89406',GradientType=0)}
.progress-warning.progress-striped .bar,.progress-striped .bar-warning{background-color:#fbb450;background-image:-webkit-gradient(linear,0 100%,100% 0,color-stop(0.25,rgba(255,255,255,0.15)),color-stop(0.25,transparent),color-stop(0.5,transparent),color-stop(0.5,rgba(255,255,255,0.15)),color-stop(0.75,rgba(255,255,255,0.15)),color-stop(0.75,transparent),to(transparent));background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-moz-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:-o-linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent);background-image:linear-gradient(45deg,rgba(255,255,255,0.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,0.15) 50%,rgba(255,255,255,0.15) 75%,transparent 75%,transparent)}
.media,.media-body{overflow:hidden;*overflow:visible;zoom:1}
.media,.media .media{margin-top:15px}
.media:first-child{margin-top:0}
.media-object{display:block}
.media-heading{margin:0 0 5px}
.media>.pull-left{margin-right:10px}
.media>.pull-right{margin-left:10px}
.media-list{margin-left:0;list-style:none}
.tooltip{position:absolute;z-index:1030;display:block;visibility:visible;font-size:11px;line-height:1.4;opacity:0;filter:alpha(opacity=0)}
.tooltip.in{opacity:0.8;filter:alpha(opacity=80)}
.tooltip.top{margin-top:-3px;padding:5px 0}
.tooltip.right{margin-left:3px;padding:0 5px}
.tooltip.bottom{margin-top:3px;padding:5px 0}
.tooltip.left{margin-left:-3px;padding:0 5px}
.tooltip-inner{max-width:200px;padding:8px;color:#fff;text-align:center;text-decoration:none;background-color:#000;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.tooltip-arrow{position:absolute;width:0;height:0;border-color:transparent;border-style:solid}
.tooltip.top .tooltip-arrow{bottom:0;left:50%;margin-left:-5px;border-width:5px 5px 0;border-top-color:#000}
.tooltip.right .tooltip-arrow{top:50%;left:0;margin-top:-5px;border-width:5px 5px 5px 0;border-right-color:#000}
.tooltip.left .tooltip-arrow{top:50%;right:0;margin-top:-5px;border-width:5px 0 5px 5px;border-left-color:#000}
.tooltip.bottom .tooltip-arrow{top:0;left:50%;margin-left:-5px;border-width:0 5px 5px;border-bottom-color:#000}
.popover{position:absolute;top:0;left:0;z-index:1010;display:none;max-width:276px;padding:1px;text-align:left;background-color:#fff;-webkit-background-clip:padding-box;-moz-background-clip:padding;background-clip:padding-box;border:1px solid #ccc;border:1px solid rgba(0,0,0,0.2);-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 5px 10px rgba(0,0,0,0.2);-moz-box-shadow:0 5px 10px rgba(0,0,0,0.2);box-shadow:0 5px 10px rgba(0,0,0,0.2);white-space:normal}
.popover.top{margin-top:-10px}
.popover.right{margin-left:10px}
.popover.bottom{margin-top:10px}
.popover.left{margin-left:-10px}
.popover-title{margin:0;padding:8px 14px;font-size:14px;font-weight:normal;line-height:18px;background-color:#f7f7f7;border-bottom:1px solid #ebebeb;-webkit-border-radius:5px 5px 0 0;-moz-border-radius:5px 5px 0 0;border-radius:5px 5px 0 0}
.popover-title:empty{display:none}
.popover-content{padding:9px 14px}
.popover .arrow,.popover .arrow:after{position:absolute;display:block;width:0;height:0;border-color:transparent;border-style:solid}
.popover .arrow{border-width:11px}
.popover .arrow:after{border-width:10px;content:""}
.popover.top .arrow{left:50%;margin-left:-11px;border-bottom-width:0;border-top-color:#999;border-top-color:rgba(0,0,0,0.25);bottom:-11px}
.popover.top .arrow:after{bottom:1px;margin-left:-10px;border-bottom-width:0;border-top-color:#fff}
.popover.right .arrow{top:50%;left:-11px;margin-top:-11px;border-left-width:0;border-right-color:#999;border-right-color:rgba(0,0,0,0.25)}
.popover.right .arrow:after{left:1px;bottom:-10px;border-left-width:0;border-right-color:#fff}
.popover.bottom .arrow{left:50%;margin-left:-11px;border-top-width:0;border-bottom-color:#999;border-bottom-color:rgba(0,0,0,0.25);top:-11px}
.popover.bottom .arrow:after{top:1px;margin-left:-10px;border-top-width:0;border-bottom-color:#fff}
.popover.left .arrow{top:50%;right:-11px;margin-top:-11px;border-right-width:0;border-left-color:#999;border-left-color:rgba(0,0,0,0.25)}
.popover.left .arrow:after{right:1px;border-right-width:0;border-left-color:#fff;bottom:-10px}
.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}
.modal-backdrop.fade{opacity:0}
.modal-backdrop,.modal-backdrop.fade.in{opacity:0.8;filter:alpha(opacity=80)}
.modal{position:fixed;top:10%;left:50%;z-index:1050;width:560px;margin-left:-280px;background-color:#fff;border:1px solid #999;border:1px solid rgba(0,0,0,0.3);*border:1px solid #999;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px;-webkit-box-shadow:0 3px 7px rgba(0,0,0,0.3);-moz-box-shadow:0 3px 7px rgba(0,0,0,0.3);box-shadow:0 3px 7px rgba(0,0,0,0.3);-webkit-background-clip:padding-box;-moz-background-clip:padding-box;background-clip:padding-box;outline:none}
.modal.fade{-webkit-transition:opacity .3s linear,top .3s ease-out;-moz-transition:opacity .3s linear,top .3s ease-out;-o-transition:opacity .3s linear,top .3s ease-out;transition:opacity .3s linear,top .3s ease-out;top:-25%}
.modal.fade.in{top:10%}
.modal-header{padding:9px 15px;border-bottom:1px solid #eee}
.modal-header .close{margin-top:2px}
.modal-header h3{margin:0;line-height:30px}
.modal-body{position:relative;overflow-y:auto;max-height:400px;padding:15px}
.modal-form{margin-bottom:0}
.modal-footer{padding:14px 15px 15px;margin-bottom:0;text-align:right;background-color:#f5f5f5;border-top:1px solid #ddd;-webkit-border-radius:0 0 6px 6px;-moz-border-radius:0 0 6px 6px;border-radius:0 0 6px 6px;-webkit-box-shadow:inset 0 1px 0 #fff;-moz-box-shadow:inset 0 1px 0 #fff;box-shadow:inset 0 1px 0 #fff;*zoom:1}
.modal-footer:before,.modal-footer:after{display:table;content:"";line-height:0}
.modal-footer:after{clear:both}
.modal-footer .btn+.btn{margin-left:5px;margin-bottom:0}
.modal-footer .btn-group .btn+.btn{margin-left:-1px}
.modal-footer .btn-block+.btn-block{margin-left:0}
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
.dropdown .dropdown-menu .nav-header{padding-left:20px;padding-right:20px}
.typeahead{z-index:1051;margin-top:2px;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.accordion{margin-bottom:20px}
.accordion-group{margin-bottom:2px;border:1px solid #e5e5e5;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.accordion-heading{border-bottom:0}
.accordion-heading .accordion-toggle{display:block;padding:8px 15px}
.accordion-toggle{cursor:pointer}
.accordion-inner{padding:9px 15px;border-top:1px solid #e5e5e5}
.well{min-height:20px;padding:19px;margin-bottom:20px;background-color:#f5f5f5;border:1px solid #e3e3e3;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);box-shadow:inset 0 1px 1px rgba(0,0,0,0.05)}
.well blockquote{border-color:#ddd;border-color:rgba(0,0,0,0.15)}
.well-large{padding:24px;-webkit-border-radius:6px;-moz-border-radius:6px;border-radius:6px}
.well-small{padding:9px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}
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
.btn-jtnavbar{cursor:pointer;margin:18px 15px 18px 0;padding:7px 10px}
.nav-jtcollapse .nav > li > a,.nav-jtcollapse .dropdown-menu a{-moz-border-radius:0;-webkit-border-radius:0;border-radius:0}
#masthead{height:75px;background:#2E3641;margin-bottom:50px;left:0;position:fixed;top:0;width:100%;z-index:999}
#page{position:relative}
.top-color div{float:left;height:5px;width:25%}
.jtcontainer{margin-right:auto;margin-left:auto;*zoom:1}
.jtcontainer:before,.jtcontainer:after{display:table;content:"";line-height:0}
.jtcontainer:after{clear:both}
#header{margin-right:30px;float:left}
#header,#header a{color:#FFF}
#header img{margin-top:13px;width:auto;max-height:60px}
#side-bar{width:300px;margin-left:30px}
#content-wrapper{margin-bottom:50px;padding-top:125px}
.post{display:block;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;margin-bottom:30px;overflow:hidden;border-bottom:2px solid #ddd}
.post h1{font-size:38.5px;font-weight:normal;line-height:100%;margin-bottom:20px}
.post img{max-width:100%}
.entry-video iframe,.thumb{display:block}
.entry-jtcontainer{background:#FFF;position:relative}
.entry-content{padding:50px}
.entry-content p{color:#525252;font-size:18px}
.entry-image{overflow:hidden;background:#F4F4F4}
.entry-image img{width:100%;-webkit-transition:all .35s ease-in-out;-moz-transition:all .35s ease-in-out;-o-transition:all .35s ease-in-out;transition:all .35s ease-in-out}
.entry-image a:hover img{-webkit-transform:scale(1.06);-moz-transform:scale(1.06);-ms-transform:scale(1.06);-o-transform:scale(1.06);transform:scale(1.06)}
.entry-meta{background:none repeat scroll 0 0 #FFF;border-radius:0 0 4px 4px;padding:15px 30px 15px;border-color:#ddd;border-style:solid;border-width:1px 0 0;position:relative;background:#fcfcfc}
.entry-meta .up_arrow:after,.entry-meta .up_arrow:before{border-color:transparent transparent #FCFCFC;border-style:solid;border-width:15px;content:"";height:0;left:40px;position:absolute;top:-30px;width:0}
.entry-meta .up_arrow:before{top:-31px;border-color:transparent transparent #DDD}
.entry-meta img{margin-right:15px;display:inline-block;-moz-border-radius:500px;-webkit-border-radius:500px;border-radius:500px}
.entry-meta h4{display:inline-block;line-height:55px}
.entry-meta h4 a{color:#878787;font-weight:normal;text-shadow:0 1px 0 #FFF;text-decoration:none;cursor:pointer}
.entry-meta .author-meta{position:relative;padding-left:50px;padding-right:50px;text-align:center}
.share-story-jtcontainer img{display:block;margin-right:5px}
.share-story-jtcontainer ul{margin:0}
.share-story-jtcontainer li{display:inline-block;width:33px;height:32px}
.sidebar .widget{background:#fff;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;margin-bottom:30px;border-bottom:2px solid #DDD}
.sidebar h2{line-height:40px;background:#5F8CB0;font-size:20px;font-weight:normal;padding:0 15px;-moz-border-radius:3px 3px 0 0;-webkit-border-radius:3px 3px 0 0;border-radius:3px 3px 0 0;color:#fff}
.sidebar ul{margin:0}
.sidebar li{line-height:20px;display:block;padding:8px 15px 8px 18px;border-bottom:1px solid #eee}
.sidebar li a{color:#717171;display:block;font-size:16px}
.sidebar li:hover{background:none repeat scroll 0 0 #F8F8F8;border-left:3px solid #F69087;padding:8px 15px}
#comments{overflow:hidden;background:#FFFFFF;border-radius:4px;border-bottom:2px solid #DDDDDD;padding:25px}
#comments h4{display:inline;padding:10px;line-height:40px}
#comments h4,.comments .comment-header,.comments .comment-thread.inline-thread .comment{position:relative}
#comments h4,.comments .continue a{background: #5F8CB0}
#comments h4,.comments .user a,.comments .continue a{font-size:16px}
#comments h4,.comments .continue a{font-weight:normal;color:#fff}
#comments h4:after{content:"";position:absolute;bottom:-10px;left:10px;border-top:10px solid #5F8CB0;border-right:20px solid transparent;width:0;height:0;line-height:0}
#comments .avatar-image-jtcontainer img{border:0}
.comment-thread{color:#111}
.comment-thread a{color:#777}
.comment-thread ol{margin:0 0 20px}
.comment-thread .comment-content a,.comments .user a,.comments .comment-thread.inline-thread .user a{color:#F69087}
.comments .avatar-image-jtcontainer,.comments .avatar-image-jtcontainer img{width:48px;max-width:48px;height:48px;max-height:48px}
.comments .comment-block,.comments .comments-content .comment-replies,.comments .comment-replybox-single{margin-left:60px}
.comments .comment-block,.comments .comment-thread.inline-thread .comment{border:1px solid #ddd;background:#f9f9f9;padding:10px}
.comments .comments-content .comment{margin:15px 0 0;padding:0;width:100%;line-height:1em}
.comments .comments-content .icon.blog-author{position:absolute;top:-12px;right:-12px;margin:0;background-image: url(https://lh4.googleusercontent.com/-yZr9CWeDr1M/UhbCd9bmLkI/AAAAAAAACjI/sllgyp7xoMc/s36/author.png);width:36px;height:36px}
.comments .comments-content .inline-thread{padding:0 0 0 20px}
.comments .comments-content .comment-replies{margin-top:0}
.comments .comment-content{padding:5px 0;line-height:1.4em}
.comments .comment-thread.inline-thread{border-left:1px solid #ddd;background:transparent}
.comments .comment-thread.inline-thread .comment{width:auto}
.comments .comment-thread.inline-thread .comment:after{content:"";position:absolute;top:10px;left:-20px;border-top:1px solid #ddd;width:10px;height:0px}
.comments .comment-thread.inline-thread .comment .comment-block{border:0;background:transparent;padding:0}
.comments .comment-thread.inline-thread .comment-block{margin-left:48px}
.comments .comment-thread.inline-thread .user a{font-size:13px}
.comments .comment-thread.inline-thread .avatar-image-jtcontainer,.comments .comment-thread.inline-thread .avatar-image-jtcontainer img{width:36px;max-width:36px;height:36px;max-height:36px}
.comments .continue{border-top:0;width:100%}
.comments .continue a{padding:10px 0;text-align:center}
.comment .continue{display:none}
#comment-editor{width:103%!important}
.comment-form{width:100%;max-width:100%}
.comments .comments-content .loadmore,.comments .comments-content {margin:0}
#blog-pager-newer-link {float: left;}
#blog-pager-older-link {float: right;}
#blog-pager { margin:0; padding:10px 0; text-align: center; clear:both; }
.pagenavi{text-align: center;}
.pagenavi > *{font-size:18px;margin-right:10px;padding:5px 13px;display:inline-block}
.pagenavi a,.pagenavi span{color:#F69087;background:none repeat scroll 0 0 #FFF;border-bottom:2px solid #DDD;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;text-decoration:none;-webkit-transition:all .1s ease-in-out;-moz-transition:all .1s ease-in-out;-o-transition:all .1s ease-in-out;transition:all .1s ease-in-out}
.pagenavi .current{color:#525252}
.pagenavi > a:hover{-webkit-transform:scale(1.1);-moz-transform:scale(1.1);-ms-transform:scale(1.1);-o-transform:scale(1.1);transform:scale(1.1)}
.Image img{max-width:300px;height:auto}
#PopularPosts1 img{float:left;margin:0 20px 0 0;border-radius:500px;display:block;height:50px;position:relative;width:50px;padding:0}
#PopularPosts1 dd{line-height:22px;margin:0;padding:8px 15px 8px 10px;position:relative;min-height:55px;border-left:3px solid transparent}
#PopularPosts1 dd:hover{background:#F8F8F8;border-left:3px solid #F69087;cursor:pointer}
#footer-bottom a{color:#F69087}
.status-msg-body{position:relative !important}
.CSS_LIGHTBOX{z-index:9999 !important}
.span9{width:610px}
.popover{min-width:220px}
#colophon{background:#2E3641;color:#FFF;position:relative}
.site-footer .jtcontainer{padding:40px 0}
#footer-body h2{font-size:20px;font-weight:normal}
#footer-body ul{margin:0}
#footer-body li{line-height:20px}
#footer-body li a{color:#fff;font-size:16px;text-decoration:none;display:inline-block;padding:2px 4px;border:none;-webkit-transition:transform 0.2s ease-in-out;-moz-transition:transform 0.2s ease-in-out;-o-transition:transform 0.2s ease-in-out;-ms-transition:transform 0.2s ease-in-out;transition:transform 0.2s ease-in-out}
#footer-body li a:hover{background:#F69087;transform:scale(1.04);-ms-transform:scale(1.04);-webkit-transform:scale(1.04);color:#fff!important}
.site-footer #footer-bottom{background:#272F3A;color:#B8B8B8;font-size:12px;padding:5px 0;text-align:center}
.FollowByEmail .btn{ -webkit-transition: all .05s ease-in-out; -moz-transition: all .05s ease-in-out; -o-transition: all .05s ease-in-out; transition: all .05s ease-in-out; background-image: -moz-linear-gradient(top, rgba(255,255,255,0.10) 0%, rgba(255,255,255,0) 100%); /* FF3.6+ */ background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,0.10)), color-stop(100%,rgba(255,255,255,0))); /* Chrome,Safari4+ */ background-image: -webkit-linear-gradient(top,  rgba(255,255,255,0.10) 0%,rgba(255,255,255,0) 100%); /* Chrome10+,Safari5.1+ */ background-image: -o-linear-gradient(top,  rgba(255,255,255,0.10) 0%,rgba(255,255,255,0) 100%); /* Opera 11.10+ */ background-image: -ms-linear-gradient(top,  rgba(255,255,255,0.10) 0%,rgba(255,255,255,0) 100%); /* IE10+ */ background-image: linear-gradient(to bottom,  rgba(255,255,255,0.10) 0%,rgba(255,255,255,0) 100%); /* W3C */ filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#40ffffff', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */
border:none; -moz-box-shadow: 0 -2px 0 0 rgba(0, 0, 0, 0.1) inset; -webkit-box-shadow: 0 -2px 0 0 rgba(0, 0, 0, 0.1) inset; box-shadow: 0 -2px 0 0 rgba(0, 0, 0, 0.1) inset; padding: 8px 20px 10px;text-align: center;vertical-align: middle;display: inline-block;font-size: 14px;line-height: 20px;margin-bottom: 0;
-webkit-border-radius:0 4px 4px 0;-moz-border-radius:0 4px 4px 0;border-radius:0 4px 4px 0;background-repeat: repeat-x;background-color: #F5F5F5;color: #333;}
.FollowByEmail .btn:hover{background-position:0;}
.FollowByEmail .btn:active,.btn:focus{box-shadow:0 2px 0 0 rgba(0, 0, 0, 0.1) inset; padding: 10px 20px 8px; outline:none!important; }
.FollowByEmail p {color: #B0B0B0;margin: 0 0 15px;}
.FollowByEmail .bl_newsletter_email {padding:0 6px;height: 38px;width: auto;}
.FollowByEmail .btn-primary{height: 40px;background-color: #1ABC9C;color: #fff;}
.FollowByEmail .btn-primary:hover{background-color: #48C9B0;}
.FollowByEmail .btn-primary:active,.btn-primary:focus{background-color: #16A085;}
@media (min-width:768px) and (max-width:979px){.hidden-desktop{display:inherit !important;} .visible-desktop{display:none !important ;} .visible-tablet{display:inherit !important;} .hidden-tablet{display:none !important;}}
@media (max-width:767px){.hidden-desktop{display:inherit !important;} .visible-desktop{display:none !important;} .visible-phone{display:inherit !important;} .hidden-phone{display:none !important;}}.visible-print{display:none !important;}
@media print{.visible-print{display:inherit !important;} .hidden-print{display:none !important;}}@media (max-width:767px){body{padding-left:20px;padding-right:20px;} .jtnavbar-fixed-top,.jtnavbar-fixed-bottom,.jtnavbar-static-top{margin-left:-20px;margin-right:-20px;} .jtcontainer-fluid{padding:0;} .dl-horizontal dt{float:none;clear:none;width:auto;text-align:left;} .dl-horizontal dd{margin-left:0;} .jtcontainer{width:auto;} .row-fluid{width:100%;} .row,.thumbnails{margin-left:0;} .thumbnails>li{float:none;margin-left:0;} [class*="span"],.uneditable-input[class*="span"],.row-fluid [class*="span"]{float:none;display:block;width:100%;margin-left:0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;} .span12,.row-fluid .span12{width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;} .row-fluid [class*="offset"]:first-child{margin-left:0;} .input-large,.input-xlarge,.input-xxlarge,input[class*="span"],select[class*="span"],textarea[class*="span"],.uneditable-input{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;} .input-prepend input,.input-append input,.input-prepend input[class*="span"],.input-append input[class*="span"]{display:inline-block;width:auto;} .controls-row [class*="span"]+[class*="span"]{margin-left:0;} .modal{position:fixed;top:20px;left:20px;right:20px;width:auto;margin:0;}.modal.fade{top:-100px;} .modal.fade.in{top:20px;}}@media (max-width:480px){.nav-jtcollapse{-webkit-transform:translate3d(0, 0, 0);} .page-header h1 small{display:block;line-height:20px;} input[type="checkbox"],input[type="radio"]{border:1px solid #ccc;} .form-horizontal .control-label{float:none;width:auto;padding-top:0;text-align:left;} .form-horizontal .controls{margin-left:0;} .form-horizontal .control-list{padding-top:0;} .form-horizontal .form-actions{padding-left:10px;padding-right:10px;} .media .pull-left,.media .pull-right{float:none;display:block;margin-bottom:10px;} .media-object{margin-right:0;margin-left:0;} .modal{top:10px;left:10px;right:10px;} .modal-header .close{padding:10px;margin:-10px;} .carousel-caption{position:static;}}@media (min-width:768px) and (max-width:979px){.row{margin-left:-20px;*zoom:1;}.row:before,.row:after{display:table;content:"";line-height:0;} .row:after{clear:both;} [class*="span"]{float:left;min-height:1px;margin-left:20px;} .jtcontainer,.jtnavbar-static-top .jtcontainer,.jtnavbar-fixed-top .jtcontainer,.jtnavbar-fixed-bottom .jtcontainer{width:724px;} .span12{width:724px;} .span11{width:662px;} .span10{width:600px;} .span9{width:538px;} .span8{width:476px;} .span7{width:414px;} .span6{width:352px;} .span5{width:290px;} .span4{width:228px;} .span3{width:166px;} .span2{width:104px;} .span1{width:42px;} .offset12{margin-left:764px;} .offset11{margin-left:702px;} .offset10{margin-left:640px;} .offset9{margin-left:578px;} .offset8{margin-left:516px;} .offset7{margin-left:454px;} .offset6{margin-left:392px;} .offset5{margin-left:330px;} .offset4{margin-left:268px;} .offset3{margin-left:206px;} .offset2{margin-left:144px;} .offset1{margin-left:82px;} .row-fluid{width:100%;*zoom:1;}.row-fluid:before,.row-fluid:after{display:table;content:"";line-height:0;} .row-fluid:after{clear:both;} .row-fluid [class*="span"]{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;float:left;margin-left:2.7624309392265194%;*margin-left:2.709239449864817%;} .row-fluid [class*="span"]:first-child{margin-left:0;} .row-fluid .controls-row [class*="span"]+[class*="span"]{margin-left:2.7624309392265194%;} .row-fluid .span12{width:100%;*width:99.94680851063829%;} .row-fluid .span11{width:91.43646408839778%;*width:91.38327259903608%;} .row-fluid .span10{width:82.87292817679558%;*width:82.81973668743387%;} .row-fluid .span9{width:74.30939226519337%;*width:74.25620077583166%;} .row-fluid .span8{width:65.74585635359117%;*width:65.69266486422946%;} .row-fluid .span7{width:57.18232044198895%;*width:57.12912895262725%;} .row-fluid .span6{width:48.61878453038674%;*width:48.56559304102504%;} .row-fluid .span5{width:40.05524861878453%;*width:40.00205712942283%;} .row-fluid .span4{width:31.491712707182323%;*width:31.43852121782062%;} .row-fluid .span3{width:22.92817679558011%;*width:22.87498530621841%;} .row-fluid .span2{width:14.3646408839779%;*width:14.311449394616199%;} .row-fluid .span1{width:5.801104972375691%;*width:5.747913483013988%;} .row-fluid .offset12{margin-left:105.52486187845304%;*margin-left:105.41847889972962%;} .row-fluid .offset12:first-child{margin-left:102.76243093922652%;*margin-left:102.6560479605031%;} .row-fluid .offset11{margin-left:96.96132596685082%;*margin-left:96.8549429881274%;} .row-fluid .offset11:first-child{margin-left:94.1988950276243%;*margin-left:94.09251204890089%;} .row-fluid .offset10{margin-left:88.39779005524862%;*margin-left:88.2914070765252%;} .row-fluid .offset10:first-child{margin-left:85.6353591160221%;*margin-left:85.52897613729868%;} .row-fluid .offset9{margin-left:79.8342541436464%;*margin-left:79.72787116492299%;} .row-fluid .offset9:first-child{margin-left:77.07182320441989%;*margin-left:76.96544022569647%;} .row-fluid .offset8{margin-left:71.2707182320442%;*margin-left:71.16433525332079%;} .row-fluid .offset8:first-child{margin-left:68.50828729281768%;*margin-left:68.40190431409427%;} .row-fluid .offset7{margin-left:62.70718232044199%;*margin-left:62.600799341718584%;} .row-fluid .offset7:first-child{margin-left:59.94475138121547%;*margin-left:59.838368402492065%;} .row-fluid .offset6{margin-left:54.14364640883978%;*margin-left:54.037263430116376%;} .row-fluid .offset6:first-child{margin-left:51.38121546961326%;*margin-left:51.27483249088986%;} .row-fluid .offset5{margin-left:45.58011049723757%;*margin-left:45.47372751851417%;} .row-fluid .offset5:first-child{margin-left:42.81767955801105%;*margin-left:42.71129657928765%;} .row-fluid .offset4{margin-left:37.01657458563536%;*margin-left:36.91019160691196%;} .row-fluid .offset4:first-child{margin-left:34.25414364640884%;*margin-left:34.14776066768544%;} .row-fluid .offset3{margin-left:28.45303867403315%;*margin-left:28.346655695309746%;} .row-fluid .offset3:first-child{margin-left:25.69060773480663%;*margin-left:25.584224756083227%;} .row-fluid .offset2{margin-left:19.88950276243094%;*margin-left:19.783119783707537%;} .row-fluid .offset2:first-child{margin-left:17.12707182320442%;*margin-left:17.02068884448102%;} .row-fluid .offset1{margin-left:11.32596685082873%;*margin-left:11.219583872105325%;} .row-fluid .offset1:first-child{margin-left:8.56353591160221%;*margin-left:8.457152932878806%;} input,textarea,.uneditable-input{margin-left:0;} .controls-row [class*="span"]+[class*="span"]{margin-left:20px;} input.span12,textarea.span12,.uneditable-input.span12{width:710px;} input.span11,textarea.span11,.uneditable-input.span11{width:648px;} input.span10,textarea.span10,.uneditable-input.span10{width:586px;} input.span9,textarea.span9,.uneditable-input.span9{width:524px;} input.span8,textarea.span8,.uneditable-input.span8{width:462px;} input.span7,textarea.span7,.uneditable-input.span7{width:400px;} input.span6,textarea.span6,.uneditable-input.span6{width:338px;} input.span5,textarea.span5,.uneditable-input.span5{width:276px;} input.span4,textarea.span4,.uneditable-input.span4{width:214px;} input.span3,textarea.span3,.uneditable-input.span3{width:152px;} input.span2,textarea.span2,.uneditable-input.span2{width:90px;} input.span1,textarea.span1,.uneditable-input.span1{width:28px;}}@media (min-width:1200px){.row{margin-left:-30px;*zoom:1;}.row:before,.row:after{display:table;content:"";line-height:0;} .row:after{clear:both;} [class*="span"]{float:left;min-height:1px;margin-left:30px;} .jtcontainer,.jtnavbar-static-top .jtcontainer,.jtnavbar-fixed-top .jtcontainer,.jtnavbar-fixed-bottom
.jtcontainer{
    /* width:1170px; */
}
.span12{width:1170px;}
.span11{width:1070px;} .span10{width:970px;} .span9{width:870px;} .span8{width:770px;} .span7{width:670px;} .span6{width:570px;} .span5{width:470px;} .span4{width:370px;} .span3{width:270px;} .span2{width:170px;} .span1{width:70px;} .offset12{margin-left:1230px;} .offset11{margin-left:1130px;} .offset10{margin-left:1030px;} .offset9{margin-left:930px;} .offset8{margin-left:830px;} .offset7{margin-left:730px;} .offset6{margin-left:630px;} .offset5{margin-left:530px;} .offset4{margin-left:430px;} .offset3{margin-left:330px;} .offset2{margin-left:230px;} .offset1{margin-left:130px;} .row-fluid{width:100%;*zoom:1;}.row-fluid:before,.row-fluid:after{display:table;content:"";line-height:0;} .row-fluid:after{clear:both;} .row-fluid [class*="span"]{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;float:left;margin-left:2.564102564102564%;*margin-left:2.5109110747408616%;} .row-fluid [class*="span"]:first-child{margin-left:0;} .row-fluid .controls-row [class*="span"]+[class*="span"]{margin-left:2.564102564102564%;} .row-fluid .span12{width:100%;*width:99.94680851063829%;} .row-fluid .span11{width:91.45299145299145%;*width:91.39979996362975%;} .row-fluid .span10{width:82.90598290598291%;*width:82.8527914166212%;} .row-fluid .span9{width:74.35897435897436%;*width:74.30578286961266%;} .row-fluid .span8{width:65.81196581196582%;*width:65.75877432260411%;} .row-fluid .span7{width:57.26495726495726%;*width:57.21176577559556%;} .row-fluid .span6{width:48.717948717948715%;*width:48.664757228587014%;} .row-fluid .span5{width:40.17094017094017%;*width:40.11774868157847%;} .row-fluid .span4{width:31.623931623931625%;*width:31.570740134569924%;} .row-fluid .span3{width:23.076923076923077%;*width:23.023731587561375%;} .row-fluid .span2{width:14.52991452991453%;*width:14.476723040552828%;} .row-fluid .span1{width:5.982905982905983%;*width:5.929714493544281%;} .row-fluid .offset12{margin-left:105.12820512820512%;*margin-left:105.02182214948171%;} .row-fluid .offset12:first-child{margin-left:102.56410256410257%;*margin-left:102.45771958537915%;} .row-fluid .offset11{margin-left:96.58119658119658%;*margin-left:96.47481360247316%;} .row-fluid .offset11:first-child{margin-left:94.01709401709402%;*margin-left:93.91071103837061%;} .row-fluid .offset10{margin-left:88.03418803418803%;*margin-left:87.92780505546462%;} .row-fluid .offset10:first-child{margin-left:85.47008547008548%;*margin-left:85.36370249136206%;} .row-fluid .offset9{margin-left:79.48717948717949%;*margin-left:79.38079650845607%;} .row-fluid .offset9:first-child{margin-left:76.92307692307693%;*margin-left:76.81669394435352%;} .row-fluid .offset8{margin-left:70.94017094017094%;*margin-left:70.83378796144753%;} .row-fluid .offset8:first-child{margin-left:68.37606837606839%;*margin-left:68.26968539734497%;} .row-fluid .offset7{margin-left:62.393162393162385%;*margin-left:62.28677941443899%;} .row-fluid .offset7:first-child{margin-left:59.82905982905982%;*margin-left:59.72267685033642%;} .row-fluid .offset6{margin-left:53.84615384615384%;*margin-left:53.739770867430444%;} .row-fluid .offset6:first-child{margin-left:51.28205128205128%;*margin-left:51.175668303327875%;} .row-fluid .offset5{margin-left:45.299145299145295%;*margin-left:45.1927623204219%;} .row-fluid .offset5:first-child{margin-left:42.73504273504273%;*margin-left:42.62865975631933%;} .row-fluid .offset4{margin-left:36.75213675213675%;*margin-left:36.645753773413354%;} .row-fluid .offset4:first-child{margin-left:34.18803418803419%;*margin-left:34.081651209310785%;} .row-fluid .offset3{margin-left:28.205128205128204%;*margin-left:28.0987452264048%;} .row-fluid .offset3:first-child{margin-left:25.641025641025642%;*margin-left:25.53464266230224%;} .row-fluid .offset2{margin-left:19.65811965811966%;*margin-left:19.551736679396257%;} .row-fluid .offset2:first-child{margin-left:17.094017094017094%;*margin-left:16.98763411529369%;} .row-fluid .offset1{margin-left:11.11111111111111%;*margin-left:11.004728132387708%;} .row-fluid .offset1:first-child{margin-left:8.547008547008547%;*margin-left:8.440625568285142%;} input,textarea,.uneditable-input{margin-left:0;} .controls-row [class*="span"]+[class*="span"]{margin-left:30px;} input.span12,textarea.span12,.uneditable-input.span12{width:1156px;} input.span11,textarea.span11,.uneditable-input.span11{width:1056px;} input.span10,textarea.span10,.uneditable-input.span10{width:956px;} input.span9,textarea.span9,.uneditable-input.span9{width:856px;} input.span8,textarea.span8,.uneditable-input.span8{width:756px;} input.span7,textarea.span7,.uneditable-input.span7{width:656px;} input.span6,textarea.span6,.uneditable-input.span6{width:556px;} input.span5,textarea.span5,.uneditable-input.span5{width:456px;} input.span4,textarea.span4,.uneditable-input.span4{width:356px;} input.span3,textarea.span3,.uneditable-input.span3{width:256px;} input.span2,textarea.span2,.uneditable-input.span2{width:156px;} input.span1,textarea.span1,.uneditable-input.span1{width:56px;} .thumbnails{margin-left:-30px;} .thumbnails>li{margin-left:30px;} .row-fluid .thumbnails{margin-left:0;}}@media (max-width:979px){body{padding-top:0;} .jtnavbar-fixed-top,.jtnavbar-fixed-bottom{position:static;} .jtnavbar-fixed-top{margin-bottom:20px;} .jtnavbar-fixed-bottom{margin-top:20px;} .jtnavbar-fixed-top .jtnavbar-inner,.jtnavbar-fixed-bottom .jtnavbar-inner{padding:5px;} .jtnavbar .jtcontainer{width:auto;padding:0;} .jtnavbar .brand{padding-left:20px;padding-right:20px;margin:0 0 0 -5px;} .nav-jtcollapse{clear:both;} .nav-jtcollapse .nav{float:none;margin:0 0 10px;} .nav-jtcollapse .nav>li{float:none;} .nav-jtcollapse .nav>li>a{margin-bottom:2px;} .nav-jtcollapse .nav>.divider-vertical{display:none;} .nav-jtcollapse .nav .nav-header{color:#777777;text-shadow:none;} .nav-jtcollapse .nav>li>a,.nav-jtcollapse .dropdown-menu a{padding:9px 15px;font-weight:bold;color:#777777;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;} .nav-jtcollapse .btn{padding:4px 10px 4px;font-weight:normal;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;} .nav-jtcollapse .dropdown-menu li+li a{margin-bottom:2px;} .nav-jtcollapse .nav>li>a:hover,.nav-jtcollapse .nav>li>a:focus,.nav-jtcollapse .dropdown-menu a:hover,.nav-jtcollapse .dropdown-menu a:focus{background-color:#f2f2f2;} .jtnavbar-inverse .nav-jtcollapse .nav>li>a,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a{color:#999999;} .jtnavbar-inverse .nav-jtcollapse .nav>li>a:hover,.jtnavbar-inverse .nav-jtcollapse .nav>li>a:focus,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:hover,.jtnavbar-inverse .nav-jtcollapse .dropdown-menu a:focus{background-color:#111111;} .nav-jtcollapse.in .btn-group{margin-top:5px;padding:0;} .nav-jtcollapse .dropdown-menu{position:static;top:auto;left:auto;float:none;display:none;max-width:none;margin:0 15px;padding:0;background-color:transparent;border:none;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;} .nav-jtcollapse .open>.dropdown-menu{display:block;} .nav-jtcollapse .dropdown-menu:before,.nav-jtcollapse .dropdown-menu:after{display:none;} .nav-jtcollapse .dropdown-menu .divider{display:none;} .nav-jtcollapse .nav>li>.dropdown-menu:before,.nav-jtcollapse .nav>li>.dropdown-menu:after{display:none;} .nav-jtcollapse .jtnavbar-form,.nav-jtcollapse .jtnavbar-search{float:none;padding:10px 15px;margin:10px 0;border-top:1px solid #f2f2f2;border-bottom:1px solid #f2f2f2;-webkit-box-shadow:inset 0 1px 0 rgba(255,255,255,.1), 0 1px 0 rgba(255,255,255,.1);-moz-box-shadow:inset 0 1px 0 rgba(255,255,255,.1), 0 1px 0 rgba(255,255,255,.1);box-shadow:inset 0 1px 0 rgba(255,255,255,.1), 0 1px 0 rgba(255,255,255,.1);} .jtnavbar-inverse .nav-jtcollapse .jtnavbar-form,.jtnavbar-inverse .nav-jtcollapse .jtnavbar-search{border-top-color:#111111;border-bottom-color:#111111;} .jtnavbar .nav-jtcollapse .nav.pull-right{float:none;margin-left:0;} 
.nav-jtcollapse,.nav-jtcollapse.jtcollapse{
	overflow:hidden;
	/*height:0;*/
} 
.jtnavbar .btn-jtnavbar{
    display:block;
    -webkit-appearance:inherit;
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
    .bl_instagram,.bl_instagram .widget-body{width:100%!important}
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
    .instagram-images-jtcontainer{width:100%;overflow-x:auto}
    #footer-body > [class*="span"]{margin-bottom:20px}
}
@media (max-width: 767px) {
    #primary,.site-footer .jtcontainer{padding-left:20px;padding-right:20px}
    .between_posts.box{padding:5px}
    body{padding:0!important}
    .entry-image{height:auto}
    #masthead{position:fixed}
    .jtcontainer{width:auto}
    [class*="span"],.uneditable-input[class*="span"],.row-fluid [class*="span"]{-moz-box-sizing:border-box;display:block;float:none;margin-left:0;width:100%}
    .row{margin-left:0}
    #side-bar{margin:0;width:100%}
    #side-bar .bl_tweets #tweets iframe{min-width:100%!important}
    .share-story{display:block;width:100%;float:none}
    .share-story li{float:none;display:table-cell;width:1%;border-right:1px solid #E6E6E6;border-top:1px solid #E6E6E6}
    .share-story li:first-child{border-left:1px solid #E6E6E6}
    .share-story li a{background:none repeat scroll 0 0 #F0F0F0;border-radius:0;text-align:center;padding:6px 0;width:100%}
    .share-story-jtcontainer{margin:0 -30px -15px;position:relative}
    .share-story-jtcontainer small{top:-23px;left:0;margin:0;position:absolute;text-align:center;width:100%}
    .entry-meta .author-meta{margin-bottom:30px}
    .share-story-jtcontainer img{margin:0 auto}
    .share-story-jtcontainer li{background:#f1eff2}
    .entry-meta > [class*="pull"]{float:none}
    .site-footer #footer-body .menu a{display:block;font-size:17px;margin:5px 0;padding:7px 10px}
    .bl_instagram,.bl_instagram .widget-body{width:100%!important}
    .instagram-images-jtcontainer{width:100%;overflow-x:auto}
    .instagram-interactions li{display:none!important}
    .instagram-interactions:before{content:'\261d';position:absolute;left:50%;top:10px;width:40px;margin:0 -20px;color:#fff;font-size:27px}
    .entry-jtcontainer .entry-content{padding:50px 20px 30px}
    .entry-meta h4{line-height:45px}
    .entry-meta .avatar{width:45px;height:45px}
    .entry-meta .author-meta{padding-left:60px}
    .entry-title{font-size:32px}
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
    article.type-page{padding:50px 20px 30px}
    #footer-body > [class*="span"]{margin-bottom:20px}
}
@media (max-width: 480px) {
    #primary{padding-left:5px;padding-right:5px}
    .jtnavbar .brand{padding-left:5px;padding-right:5px}
    .bl_background{display:none}
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
			<li>
			  <a href='/'>Home</a>
			</li>
			<li>
			  <a href="https://www.linkedin.com/in/joshuatzucker" target="_blank" id="linkedIn">About / <i class="fa fa-linkedin-square" style="font-size:large"></i>
				</a>
			</li>
            <li>
                <a href="/custom-tools/">Custom Developed Tools</a>
            </li>
			<li class='dropdown'>
			  <a class='dropdown-toggle' data-toggle='dropdown' href='/projects/'>Projects</a>
			  <ul class='dropdown-menu'>
                <?php foreach($projectTerms as $projectTerm): ?>
                    <li class="dropdown">
                        <a href="<?php echo get_term_link($projectTerm);?>"><?php echo $projectTerm->name; ?></a>
                    </li>
                <?php endforeach; ?>
			  </ul>
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
	  </div>
	</div>
  </div>
  <div class='clear'></div>
</div>

<!-- Scripts -->
<script>
var G = "/", C = location.href, H, D, B, F;
//I();
function loophalaman(a) {
    var b = "";
    nomerkiri = parseInt(num / 2);
    if (nomerkiri == num - nomerkiri)
        num = nomerkiri * 2 + 1;
    mulai = B - nomerkiri;
    if (mulai < 1)
        mulai = 1;
    maksimal = parseInt(a / posts) + 1;
    if (maksimal - 1 == a / posts)
        maksimal = maksimal - 1;
    akhir = mulai + num - 1;
    if (akhir > maksimal)
        akhir = maksimal;
    b += "<span class='pages'>Page " + B + " of " + maksimal + "</span>";
    var c = parseInt(B) - 1;
    if (B > 1)
        if (B == 2)
            if (D == "page")
                b += '<a href="' + G + '">' + previous + "</a>";
            else
                b += '<a href="/search/label/' + F + "?&max-results=" + posts + '">' + previous + "</a>";
        else if (D == "page")
            b += '<a href="#" onclick="redirectpage(' + c + ');return false">' + previous + "</a>";
        else
            b += '<a href="#" onclick="redirectlabel(' + c + ');return false">' + previous + "</a>";
    for (var d = mulai; d <= akhir; d++)
        if (B == d)
            b += '<span class="current">' + d + "</span>";
        else if (d == 1)
            if (D == "page")
                b += '<a href="' + G + '">1</a>';
            else
                b += '<a href="/search/label/' + F + "?&max-results=" + posts + '">1</a>';
        else if (D == "page")
            b += '<a href="#" onclick="redirectpage(' + d + ');return false">' + d + "</a>";
        else
            b += '<a href="#" onclick="redirectlabel(' + d + ');return false">' + d + "</a>";
    var e = parseInt(B) + 1;
    if (B < maksimal)
        if (D == "page")
            b += '<a href="#" onclick="redirectpage(' + e + ');return false">' + next + "</a>";
        else
            b += '<a href="#" onclick="redirectlabel(' + e + ');return false">' + next + "</a>";
    var f = document.getElementsByName("pageArea");
    var g = document.getElementById("blog-pager");
    for (var p = 0; p < f.length; p++)
        f[p].innerHTML = b;
    if (f && f.length > 0)
        b = "";
    if (g)
        g.innerHTML = '<div class="pagenavi">' + b + "</div>"
}
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
    var b = function(b, c) {
        this.options = c,
        this.$element = a(b).delegate('[data-dismiss="modal"]', "click.dismiss.modal", a.proxy(this.hide, this)),
        this.options.remote && this.$element.find(".modal-body").load(this.options.remote)
    }
    ;
    b.prototype = {
        constructor: b,
        toggle: function() {
            return this[this.isShown ? "hide" : "show"]()
        },
        show: function() {
            var b = this
              , c = a.Event("show");
            this.$element.trigger(c);
            if (this.isShown || c.isDefaultPrevented())
                return;
            this.isShown = true,
            this.escape(),
            this.backdrop(function() {
                var c = a.support.transition && b.$element.hasClass("fade");
                b.$element.parent().length || b.$element.appendTo(document.body),
                b.$element.show(),
                c && b.$element[0].offsetWidth,
                b.$element.addClass("in").attr("aria-hidden", false),
                b.enforceFocus(),
                c ? b.$element.one(a.support.transition.end, function() {
                    b.$element.focus().trigger("shown")
                }) : b.$element.focus().trigger("shown")
            })
        },
        hide: function(b) {
            b && b.preventDefault();
            var c = this;
            b = a.Event("hide"),
            this.$element.trigger(b);
            if (!this.isShown || b.isDefaultPrevented())
                return;
            this.isShown = false,
            this.escape(),
            a(document).off("focusin.modal"),
            this.$element.removeClass("in").attr("aria-hidden", true),
            a.support.transition && this.$element.hasClass("fade") ? this.hideWithTransition() : this.hideModal()
        },
        enforceFocus: function() {
            var b = this;
            a(document).on("focusin.modal", function(a) {
                b.$element[0] !== a.target && (!b.$element.has(a.target).length && b.$element.focus())
            })
        },
        escape: function() {
            var a = this;
            this.isShown && this.options.keyboard ? this.$element.on("keyup.dismiss.modal", function(b) {
                b.which == 27 && a.hide()
            }) : this.isShown || this.$element.off("keyup.dismiss.modal")
        },
        hideWithTransition: function() {
            var b = this
              , c = setTimeout(function() {
                b.$element.off(a.support.transition.end),
                b.hideModal()
            }, 500);
            this.$element.one(a.support.transition.end, function() {
                clearTimeout(c),
                b.hideModal()
            })
        },
        hideModal: function() {
            var a = this;
            this.$element.hide(),
            this.backdrop(function() {
                a.removeBackdrop(),
                a.$element.trigger("hidden")
            })
        },
        removeBackdrop: function() {
            this.$backdrop && this.$backdrop.remove(),
            this.$backdrop = null
        },
        backdrop: function(b) {
            var c = this
              , d = this.$element.hasClass("fade") ? "fade" : "";
            if (this.isShown && this.options.backdrop) {
                var e = a.support.transition && d;
                this.$backdrop = a('<div class="modal-backdrop ' + d + '" />').appendTo(document.body),
                this.$backdrop.click(this.options.backdrop == "static" ? a.proxy(this.$element[0].focus, this.$element[0]) : a.proxy(this.hide, this)),
                e && this.$backdrop[0].offsetWidth,
                this.$backdrop.addClass("in");
                if (!b)
                    return;
                e ? this.$backdrop.one(a.support.transition.end, b) : b()
            } else
                !this.isShown && this.$backdrop ? (this.$backdrop.removeClass("in"),
                a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one(a.support.transition.end, b) : b()) : b && b()
        }
    };
    var c = a.fn.modal;
    a.fn.modal = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("modal")
              , f = a.extend({}, a.fn.modal.defaults, d.data(), typeof c == "object" && c);
            e || d.data("modal", e = new b(this,f)),
            typeof c == "string" ? e[c]() : f.show && e.show()
        })
    }
    ,
    a.fn.modal.defaults = {
        backdrop: true,
        keyboard: true,
        show: true
    },
    a.fn.modal.Constructor = b,
    a.fn.modal.noConflict = function() {
        return a.fn.modal = c,
        this
    }
    ,
    a(document).on("click.modal.data-api", '[data-toggle="modal"]', function(b) {
        var c = a(this)
          , d = c.attr("href")
          , e = a(c.attr("data-target") || d && d.replace(/.*(?=#[^\s]+$)/, ""))
          , f = e.data("modal") ? "toggle" : a.extend({
            remote: !/#/.test(d) && d
        }, e.data(), c.data());
        b.preventDefault(),
        e.modal(f).one("hide", function() {
            c.focus()
        })
    })
}(window.jQuery),
!function(a) {
    function d() {
        a(".dropdown-backdrop").remove(),
        a(b).each(function() {
            e(a(this)).removeClass("open")
        })
    }
    function e(b) {
        var c = b.attr("data-target"), d;
        c || (c = b.attr("href"),
        c = c && (/#/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""))),
        d = c && a(c);
        if (!d || !d.length)
            d = b.parent();
        return d
    }
    var b = "[data-toggle=dropdown]"
      , c = function(b) {
        var c = a(b).on("click.dropdown.data-api", this.toggle);
        a("html").on("click.dropdown.data-api", function() {
            c.parent().removeClass("open")
        })
    }
    ;
    c.prototype = {
        constructor: c,
        toggle: function(b) {
            var c = a(this), f, g;
            if (c.is(".disabled, :disabled"))
                return;
            return f = e(c),
            g = f.hasClass("open"),
            d(),
            g || ("disable-ontouchstart"in document.documentElement && a('<div class="dropdown-backdrop"/>').insertBefore(a(this)).on("click", d),
            f.toggleClass("open")),
            c.focus(),
            false
        },
        keydown: function(c) {
            var d, f, g, h, i, j;
            if (!/(38|40|27)/.test(c.keyCode))
                return;
            d = a(this),
            c.preventDefault(),
            c.stopPropagation();
            if (d.is(".disabled, :disabled"))
                return;
            h = e(d),
            i = h.hasClass("open");
            if (!i || i && c.keyCode == 27)
                return c.which == 27 && h.find(b).focus(),
                d.click();
            f = a("[role=menu] li:not(.divider):visible a", h);
            if (!f.length)
                return;
            j = f.index(f.filter(":focus")),
            c.keyCode == 38 && (j > 0 && j--),
            c.keyCode == 40 && (j < f.length - 1 && j++),
            ~j || (j = 0),
            f.eq(j).focus()
        }
    };
    var f = a.fn.dropdown;
    a.fn.dropdown = function(b) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("dropdown");
            e || d.data("dropdown", e = new c(this)),
            typeof b == "string" && e[b].call(d)
        })
    }
    ,
    a.fn.dropdown.Constructor = c,
    a.fn.dropdown.noConflict = function() {
        return a.fn.dropdown = f,
        this
    }
    ,
    a(document).on("click.dropdown.data-api", d).on("click.dropdown.data-api", ".dropdown form", function(a) {
        a.stopPropagation()
    }).on("click.dropdown.data-api", b, c.prototype.toggle).on("keydown.dropdown.data-api", b + ", [role=menu]", c.prototype.keydown)
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
    var b = function(a, b) {
        this.init("tooltip", a, b)
    }
    ;
    b.prototype = {
        constructor: b,
        init: function(b, c, d) {
            var e, f, g, h, i;
            this.type = b,
            this.$element = a(c),
            this.options = this.getOptions(d),
            this.enabled = true,
            g = this.options.trigger.split(" ");
            for (i = g.length; i--; )
                h = g[i],
                h == "click" ? this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this)) : h != "manual" && (e = h == "hover" ? "mouseenter" : "focus",
                f = h == "hover" ? "mouseleave" : "blur",
                this.$element.on(e + "." + this.type, this.options.selector, a.proxy(this.enter, this)),
                this.$element.on(f + "." + this.type, this.options.selector, a.proxy(this.leave, this)));
            this.options.selector ? this._options = a.extend({}, this.options, {
                trigger: "manual",
                selector: ""
            }) : this.fixTitle()
        },
        getOptions: function(b) {
            return b = a.extend({}, a.fn[this.type].defaults, this.$element.data(), b),
            b.delay && (typeof b.delay == "number" && (b.delay = {
                show: b.delay,
                hide: b.delay
            })),
            b
        },
        enter: function(b) {
            var c = a.fn[this.type].defaults, d = {}, e;
            this._options && a.each(this._options, function(a, b) {
                c[a] != b && (d[a] = b)
            }, this),
            e = a(b.currentTarget)[this.type](d).data(this.type);
            if (!e.options.delay || !e.options.delay.show)
                return e.show();
            clearTimeout(this.timeout),
            e.hoverState = "in",
            this.timeout = setTimeout(function() {
                e.hoverState == "in" && e.show()
            }, e.options.delay.show)
        },
        leave: function(b) {
            var c = a(b.currentTarget)[this.type](this._options).data(this.type);
            this.timeout && clearTimeout(this.timeout);
            if (!c.options.delay || !c.options.delay.hide)
                return c.hide();
            c.hoverState = "out",
            this.timeout = setTimeout(function() {
                c.hoverState == "out" && c.hide()
            }, c.options.delay.hide)
        },
        show: function() {
            var b, c, d, e, f, g, h = a.Event("show");
            if (this.hasContent() && this.enabled) {
                this.$element.trigger(h);
                if (h.isDefaultPrevented())
                    return;
                b = this.tip(),
                this.setContent(),
                this.options.animation && b.addClass("fade"),
                f = typeof this.options.placement == "function" ? this.options.placement.call(this, b[0], this.$element[0]) : this.options.placement,
                b.detach().css({
                    top: 0,
                    left: 0,
                    display: "block"
                }),
                this.options.jtcontainer ? b.appendTo(this.options.jtcontainer) : b.insertAfter(this.$element),
                c = this.getPosition(),
                d = b[0].offsetWidth,
                e = b[0].offsetHeight;
                switch (f) {
                case "bottom":
                    g = {
                        top: c.top + c.height,
                        left: c.left + c.width / 2 - d / 2
                    };
                    break;
                case "top":
                    g = {
                        top: c.top - e,
                        left: c.left + c.width / 2 - d / 2
                    };
                    break;
                case "left":
                    g = {
                        top: c.top + c.height / 2 - e / 2,
                        left: c.left - d
                    };
                    break;
                case "right":
                    g = {
                        top: c.top + c.height / 2 - e / 2,
                        left: c.left + c.width
                    };
                default:
                }
                this.applyPlacement(g, f),
                this.$element.trigger("shown")
            }
        },
        applyPlacement: function(a, b) {
            var c = this.tip(), d = c[0].offsetWidth, e = c[0].offsetHeight, f, g, h, i;
            c.offset(a).addClass(b).addClass("in"),
            f = c[0].offsetWidth,
            g = c[0].offsetHeight,
            b == "top" && (g != e && (a.top = a.top + e - g,
            i = true)),
            b == "bottom" || b == "top" ? (h = 0,
            a.left < 0 && (h = a.left * -2,
            a.left = 0,
            c.offset(a),
            f = c[0].offsetWidth,
            g = c[0].offsetHeight),
            this.replaceArrow(h - d + f, f, "left")) : this.replaceArrow(g - e, g, "top"),
            i && c.offset(a)
        },
        replaceArrow: function(a, b, c) {
            this.arrow().css(c, a ? 50 * (1 - a / b) + "%" : "")
        },
        setContent: function() {
            var a = this.tip()
              , b = this.getTitle();
            a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b),
            a.removeClass("fade in top bottom left right")
        },
        hide: function() {
            function e() {
                var b = setTimeout(function() {
                    c.off(a.support.transition.end).detach()
                }, 500);
                c.one(a.support.transition.end, function() {
                    clearTimeout(b),
                    c.detach()
                })
            }
            var b = this
              , c = this.tip()
              , d = a.Event("hide");
            this.$element.trigger(d);
            if (d.isDefaultPrevented())
                return;
            return c.removeClass("in"),
            a.support.transition && this.$tip.hasClass("fade") ? e() : c.detach(),
            this.$element.trigger("hidden"),
            this
        },
        fixTitle: function() {
            var a = this.$element;
            (a.attr("title") || typeof a.attr("data-original-title") != "string") && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
        },
        hasContent: function() {
            return this.getTitle()
        },
        getPosition: function() {
            var b = this.$element[0];
            return a.extend({}, typeof b.getBoundingClientRect == "function" ? b.getBoundingClientRect() : {
                width: b.offsetWidth,
                height: b.offsetHeight
            }, this.$element.offset())
        },
        getTitle: function() {
            var a, b = this.$element, c = this.options;
            return a = b.attr("data-original-title") || (typeof c.title == "function" ? c.title.call(b[0]) : c.title),
            a
        },
        tip: function() {
            return this.$tip = this.$tip || a(this.options.template)
        },
        arrow: function() {
            return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
        },
        validate: function() {
            this.$element[0].parentNode || (this.hide(),
            this.$element = null ,
            this.options = null )
        },
        enable: function() {
            this.enabled = true
        },
        disable: function() {
            this.enabled = false
        },
        toggleEnabled: function() {
            this.enabled = !this.enabled
        },
        toggle: function(b) {
            var c = b ? a(b.currentTarget)[this.type](this._options).data(this.type) : this;
            c.tip().hasClass("in") ? c.hide() : c.show()
        },
        destroy: function() {
            this.hide().$element.off("." + this.type).removeData(this.type)
        }
    };
    var c = a.fn.tooltip;
    a.fn.tooltip = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("tooltip")
              , f = typeof c == "object" && c;
            e || d.data("tooltip", e = new b(this,f)),
            typeof c == "string" && e[c]()
        })
    }
    ,
    a.fn.tooltip.Constructor = b,
    a.fn.tooltip.defaults = {
        animation: true,
        placement: "top",
        selector: false,
        template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: false,
        jtcontainer: false
    },
    a.fn.tooltip.noConflict = function() {
        return a.fn.tooltip = c,
        this
    }
}(window.jQuery),
!function(a) {
    var b = function(b, c) {
        this.options = a.extend({}, a.fn.affix.defaults, c),
        this.$window = a(window).on("scroll.affix.data-api", a.proxy(this.checkPosition, this)).on("click.affix.data-api", a.proxy(function() {
            setTimeout(a.proxy(this.checkPosition, this), 1)
        }, this)),
        this.$element = a(b),
        this.checkPosition()
    }
    ;
    b.prototype.checkPosition = function() {
        if (!this.$element.is(":visible"))
            return;
        var b = a(document).height(), c = this.$window.scrollTop(), d = this.$element.offset(), e = this.options.offset, f = e.bottom, g = e.top, h = "affix affix-top affix-bottom", i;
        typeof e != "object" && (f = g = e),
        typeof g == "function" && (g = e.top()),
        typeof f == "function" && (f = e.bottom()),
        i = this.unpin != null && c + this.unpin <= d.top ? false : f != null && d.top + this.$element.height() >= b - f ? "bottom" : g != null && c <= g ? "top" : false;
        if (this.affixed === i)
            return;
        this.affixed = i,
        this.unpin = i == "bottom" ? d.top - c : null ,
        this.$element.removeClass(h).addClass("affix" + (i ? "-" + i : ""))
    }
    ;
    var c = a.fn.affix;
    a.fn.affix = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("affix")
              , f = typeof c == "object" && c;
            e || d.data("affix", e = new b(this,f)),
            typeof c == "string" && e[c]()
        })
    }
    ,
    a.fn.affix.Constructor = b,
    a.fn.affix.defaults = {
        offset: 0
    },
    a.fn.affix.noConflict = function() {
        return a.fn.affix = c,
        this
    }
    ,
    a(window).on("load", function() {
        a('[data-spy="affix"]').each(function() {
            var b = a(this)
              , c = b.data();
            c.offset = c.offset || {},
            c.offsetBottom && (c.offset.bottom = c.offsetBottom),
            c.offsetTop && (c.offset.top = c.offsetTop),
            b.affix(c)
        })
    })
}(window.jQuery),
!function(a) {
    var b = '[data-dismiss="alert"]'
      , c = function(c) {
        a(c).on("click", b, this.close)
    }
    ;
    c.prototype.close = function(b) {
        function f() {
            e.trigger("closed").remove()
        }
        var c = a(this), d = c.attr("data-target"), e;
        d || (d = c.attr("href"),
        d = d && d.replace(/.*(?=#[^\s]*$)/, "")),
        e = a(d),
        b && b.preventDefault(),
        e.length || (e = c.hasClass("alert") ? c : c.parent()),
        e.trigger(b = a.Event("close"));
        if (b.isDefaultPrevented())
            return;
        e.removeClass("in"),
        a.support.transition && e.hasClass("fade") ? e.on(a.support.transition.end, f) : f()
    }
    ;
    var d = a.fn.alert;
    a.fn.alert = function(b) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("alert");
            e || d.data("alert", e = new c(this)),
            typeof b == "string" && e[b].call(d)
        })
    }
    ,
    a.fn.alert.Constructor = c,
    a.fn.alert.noConflict = function() {
        return a.fn.alert = d,
        this
    }
    ,
    a(document).on("click.alert.data-api", b, c.prototype.close)
}(window.jQuery),
!function(a) {
    var b = function(b, c) {
        this.$element = a(b),
        this.options = a.extend({}, a.fn.button.defaults, c)
    }
    ;
    b.prototype.setState = function(a) {
        var b = "disabled"
          , c = this.$element
          , d = c.data()
          , e = c.is("input") ? "val" : "html";
        a += "Text",
        d.resetText || c.data("resetText", c[e]()),
        c[e](d[a] || this.options[a]),
        setTimeout(function() {
            a == "loadingText" ? c.addClass(b).attr(b, b) : c.removeClass(b).removeAttr(b)
        }, 0)
    }
    ,
    b.prototype.toggle = function() {
        var a = this.$element.closest('[data-toggle="buttons-radio"]');
        a && a.find(".active").removeClass("active"),
        this.$element.toggleClass("active")
    }
    ;
    var c = a.fn.button;
    a.fn.button = function(c) {
        return this.each(function() {
            var d = a(this)
              , e = d.data("button")
              , f = typeof c == "object" && c;
            e || d.data("button", e = new b(this,f)),
            c == "toggle" ? e.toggle() : c && e.setState(c)
        })
    }
    ,
    a.fn.button.defaults = {
        loadingText: "loading..."
    },
    a.fn.button.Constructor = b,
    a.fn.button.noConflict = function() {
        return a.fn.button = c,
        this
    }
    ,
    a(document).on("click.button.data-api", "[data-toggle^=button]", function(b) {
        var c = a(b.target);
        c.hasClass("btn") || (c = c.closest(".btn")),
        c.button("toggle")
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
jQuery(function() {
    if (jQuery(".above_header").length > 0)
        var a = jQuery(".above_header").height();
    else
        var a = 0;
    jQuery("#masthead").affix({
        offset: a
    })
});

</script>
<!-- End Scripts -->

<script>
/**
* WP Admin bar fix 
*/
(function($){
    $(document).ready(function(){
        var wpAdminBarElem = document.querySelector('div#wpadminbar');
        console.log((wpAdminBarElem));
        console.log(typeof(wpAdminBarElem));
        if (typeof(wpAdminBarElem)==='object' && wpAdminBarElem!==null){
            var wpAdminBarHeight = window.getComputedStyle(wpAdminBarElem).height;
            $('.mainNavContainerWrapper').css({
                'top' : wpAdminBarHeight
            });
        }
    })
})(jQuery);
</script>

<style>
    <?php // If width is SMALLER than breakpoint ?>
    @media (max-width: <?php echo $navBreakpointPx; ?>){
        #masthead .titlewrapper h1.title {
            font-weight:normal;
            line-height:20px;
            margin-top:20px;
            margin-left:30px;
            font-size: 36px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }
        #header-inner > .titlewrapper {
            position: relative;
        }
    }

    <?php // If width is LARGER than breakpoint ?>
    @media (min-width: <?php echo $navBreakpointPx; ?>){
        #masthead .titlewrapper h1.title {
            font-size : 44px;
            margin-top: 7px;
        }
    }
</style>