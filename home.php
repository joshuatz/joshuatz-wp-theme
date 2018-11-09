<?php
/**
 * Special: Home page template file
 */
?>
<?php get_header(); ?>

<div id="main">
    
    <div style="width:300px; height: 600px; color:blue; display: none"></div>
        
    <div style="background:rgba(255, 255, 255, 0.47); padding-top:4px">
        <p style="background:rgba(255, 255, 255, 0.9); width: 80%; margin-left: auto; margin-right: auto; border-radius: 4px; padding: 8px;">Welcome to the home page for Joshua Tzucker. This site serves as a pseudo-portfolio of some of my larger projects, as well as links to other projects. Please use the navigation bar at the top to navigate the site, or alternatively, use the project categories below.</p>
        
        <div id="mainmenu">
            <a href="/electronics" class="hvr-bob myButton menubutton">Electronics</a>
            <a href="/marketing" class="hvr-bob myButton menubutton">Marketing</a>
            <a href="/web-stuff" class="hvr-bob myButton menubutton">Web Stuff</a>
            <a href="/writing" class="hvr-bob myButton menubutton">Writing</a>
            <a href="/other" class="hvr-bob myButton menubutton">Other</a>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>