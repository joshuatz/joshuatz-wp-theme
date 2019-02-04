<?php
/**
 * Special: Home page template file - doesn't show posts, just shows custom home page
 */
?>
<?php get_header(); ?>

<?php
    // Nav processing
    $projectTerms = $jtzwpHelpers->getProjectTypesTerms();
?>

<div id="main">
    <div style="background:rgba(255, 255, 255, 0.47); padding-top:4px; margin:10px 8px; min-height:500px;" class="">
        <div class="" style="width:100%;">
            <div>
                <div class="row">
                    <h1 style="font-size:2rem; margin:20px 0px 0px 0px;">Homepage of Joshua Tzucker</h1>
                </div>
                <div class="row">
                    <div class="col s10 offset-s1">
                        <div class="card-panel white z-depth-4">
                            <span class="flow-text">Welcome to the home page for Joshua Tzucker. This site serves as a pseudo-portfolio of some of my larger projects, as well as links to other projects. Please use the navigation bar at the top to navigate the site, or alternatively, use the project categories below.</span>
                        </div>
                    </div>
                </div>
                
                <div id="mainmenu">
                    <?php $secDelay = 0.5; ?>
                    <?php foreach($projectTerms as $projectTerm): ?>
                        <?php $secDelay = $secDelay + 0.5; ?>
                        <div class="wow bounce homepageButtonWrapper" data-wow-delay="<?php echo $secDelay; ?>s" style="display:inline-block;">
                            <a href="<?php echo get_term_link($projectTerm);?>" class="hvr-bob homepageButton"><?php echo $projectTerm->name; ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_sidebar('homepage'); ?>
<?php get_footer(); ?>