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
            <div id="mainmenu" class="col s12 m12 l7">
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