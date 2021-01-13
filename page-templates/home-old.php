<?php
/**
 * Template Name: Old Homepage
 * Template Post Type: page
 * Special: Home page template file - doesn't show posts, just shows custom home page
 * @file - Old, previous default homepage template. Mostly just buttons that link to subpages
 */
?>
<?php get_header(); ?>

<!-- Inline some styles, since I'm not using this page much, and I don't want these cluttering up style.css -->
<style>
/**
* Homepage - old style
*/
.mediumDividerDashed {
    height: auto;
    overflow: hidden;
    background-color: unset !important;
    border-bottom: 2px dashed black;
    margin-bottom: 10px;
}
.homepageButtonSection {
    border: 1px dashed black;
    margin: 18px;
    border-radius: 10px;
    background: rgba(255, 255, 255,0.5);
    padding: 0px 0px 10px 0px;
}
.homepageButtonWrapper {
    padding: 8px;
}
.projectsByTypeButtonWrapper .homepageButton {
    font-size: 14px;
    padding: 14px 20px;
}
.homepageOtherButtonsWrapper .homepageButton {
    font-size: 18px;
    padding: 14px 20px;
}
.homepageUpper {
    background: rgba(255, 255, 255, 0.47);
    padding-top: 4px;
    margin: 10px 8px 10px 8px;
    padding-bottom: 10px;
}
.homepageUpper .aboutMeCard, .homepageUpper .businessCard {
    margin: 0px 0px 12px 0px;
}
.homepageButton {
    -moz-box-shadow: 0px 10px 14px -7px #2c62a2;
    -webkit-box-shadow: 0px 10px 14px -7px #2c62a2;
    box-shadow: 0px 10px 14px -7px #2c62a2;
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2e3641), color-stop(1, #2c68b0));
    background:-moz-linear-gradient(top, #2e3641 5%, #2c68b0 100%);
    background:-webkit-linear-gradient(top, #2e3641 5%, #2c68b0 100%);
    background:-o-linear-gradient(top, #2e3641 5%, #2c68b0 100%);
    background:-ms-linear-gradient(top, #2e3641 5%, #2c68b0 100%);
    background:linear-gradient(to bottom, #2e3641 5%, #2c68b0 100%);
    background-color:#2c68b0;
    -moz-border-radius:20px;
    -webkit-border-radius:20px;
    border-radius:20px;
    display:inline-block;
    cursor:pointer;
    color:#ffffff;
    font-family:arial;
    font-size:20px;
    font-weight:bold;
    padding:18px 32px;
    text-decoration:none;
    /* text-shadow:0px 5px 15px #2d6375; */
}
.homepageButton:hover {
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #408c99), color-stop(1, #599bb3));
    background:-moz-linear-gradient(top, #408c99 5%, #599bb3 100%);
    background:-webkit-linear-gradient(top, #408c99 5%, #599bb3 100%);
    background:-o-linear-gradient(top, #408c99 5%, #599bb3 100%);
    background:-ms-linear-gradient(top, #408c99 5%, #599bb3 100%);
    background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
    background-color:#408c99;
}
.homepageButton:active {
    position:relative;
    top:1px;
}
.homepageButton{
    min-width:90px;
}
/* Bob */
@-webkit-keyframes hvr-bob {
    0% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
    
    50% {
        -webkit-transform: translateY(-4px);
        transform: translateY(-4px);
    }
    
    100% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
}

@keyframes hvr-bob {
    0% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
    
    50% {
        -webkit-transform: translateY(-4px);
        transform: translateY(-4px);
    }
    
    100% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
}

@-webkit-keyframes hvr-bob-float {
    100% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
}

@keyframes hvr-bob-float {
    100% {
        -webkit-transform: translateY(-8px);
        transform: translateY(-8px);
    }
}

.hvr-bob {
    display: inline-block;
    vertical-align: middle;
    -webkit-transform: translateZ(0);
    transform: translateZ(0);
    box-shadow: 0 0 1px rgba(0, 0, 0, 0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -moz-osx-font-smoothing: grayscale;
}
.hvr-bob:hover, .hvr-bob:focus, .hvr-bob:active {
    -webkit-animation-name: hvr-bob-float, hvr-bob;
    animation-name: hvr-bob-float, hvr-bob;
    -webkit-animation-duration: .3s, 1.5s;
    animation-duration: .3s, 1.5s;
    -webkit-animation-delay: 0s, .3s;
    animation-delay: 0s, .3s;
    -webkit-animation-timing-function: ease-out, ease-in-out;
    animation-timing-function: ease-out, ease-in-out;
    -webkit-animation-iteration-count: 1, infinite;
    animation-iteration-count: 1, infinite;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    -webkit-animation-direction: normal, alternate;
    animation-direction: normal, alternate;
}
</style>

<?php
    // Nav processing
    $projectTerms = $jtzwpHelpers->getProjectTypesTerms();
?>

<main id="main" role="main">
    <?php get_sidebar('everypagetop'); ?>
    <div class="homepageUpper">
        <div class="row">
            <h1 style="font-size:2rem; margin:20px 0px 0px 0px;">Homepage of Joshua Tzucker</h1>
        </div>
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card-panel white z-depth-4">
                    <span class="flow-text">Welcome to the home page for Joshua Tzucker. This site serves as a portfolio of some of my larger projects, as well as links to other projects. Please use the navigation bar at the top to navigate the site, or alternatively, use the project categories below.</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="textCenter col s12 m12 l7">
                <?php 
                    $secDelay = 0.5;
                    $homepageButtonsMisc = array(
                        array('link'=>'/custom-tools/','text'=>'One-Off Tools'),
                        array('link'=>'/blog/','text'=>'Blog')
                    );
                    $homepageButtonsProjects = array();
                    foreach($projectTerms as $projectTerm){
                        array_unshift($homepageButtonsProjects,array(
                            'link' => get_term_link($projectTerm),
                            'text' => $projectTerm->name
                        ));
                    }

                    function getHomepageButtonHtml($homepageButton){
                        ?>
                        <?php
                            // Add delay each time called so bounces cascade
                            global $secDelay;
                            $secDelay = $secDelay + 0.5;
                        ?>
                        <div class="wow bounce homepageButtonWrapper" data-wow-delay="<?php echo $secDelay; ?>s" style="display:inline-block;">
                            <a href="<?php echo $homepageButton['link'];?>" class="hvr-bob homepageButton"><?php echo $homepageButton['text']; ?></a>
                        </div>
                        <?php
                    }
                ?>
                <!-- Projects First -->
                <div class="homepageProjectButtonsWrapper homepageButtonSection">
                    <h2 class="title bold">Project Links:</h2>
                    <div class="allProjectsButtonWrapper">
                        <?php getHomepageButtonHtml(array(
                            'link' => '/projects',
                            'text' => 'ALL Projects'
                        )); ?>
                    </div>
                    <div class="mediumDividerDashed" style="width: 80%; margin: 8px auto; border-color: rgba(0, 0, 0, 0.3);"></div>
                    <div class="projectsByTypeButtonWrapper">
                        <?php foreach($homepageButtonsProjects as $homepageButton): ?>
                            <?php getHomepageButtonHtml($homepageButton); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Then others -->
                <div class="homepageOtherButtonsWrapper homepageButtonSection">
                    <h2 class="title bold">Other Sections:</h2>
                    <?php foreach($homepageButtonsMisc as $homepageButton): ?>
                        <?php getHomepageButtonHtml($homepageButton); ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col s12 m12 l5">
                <?php get_template_part('partials/about-me-card'); ?>
                <?php get_template_part('partials/business-card-materialize'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_sidebar('homepage'); ?>
<?php get_footer(); ?>