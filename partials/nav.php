<?php
/**
 * @file Navigation Menu 2.0
 */
/** @var JtzwpHelpers $jtzwpHelpers */
global $jtzwpHelpers;
$projectTerms = $jtzwpHelpers->getProjectTypesTerms();
// The business card materialize modal can really only be reliably shown on WP pages, so change to link to homepage and about popup if on non wp
$aboutMeLink = $jtzwpHelpers->isPageWP()===true ? '#businessCardMaterializeModal' : '/#businessCardMaterializeModal';
$aboutMeTarget = $jtzwpHelpers->isPageWP()===true ? '_self' : '_blank';
?>

<nav class="full jtNavBar browser-default" data-collapsed="false">
    <!-- Menu Open/Close Toggle -->
    <button class="navToggle hideFull">
        <svg enable-background="new 0 0 512 512" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="100%" height="100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><rect height="64" width="256" x="128" y="320"/><rect height="64" width="256" x="128" y="224"/><path d="M480,0H32C14.312,0,0,14.312,0,32v448c0,17.688,14.312,32,32,32h448c17.688,0,32-14.312,32-32V32   C512,14.312,497.688,0,480,0z M448,448H64V64h384V448z"/><rect height="64" width="256" x="128" y="128"/></g></svg>
    </button>
    <!-- Title -->
    <div class="title">
        <a href='/' title="Home">Joshuatz.com</a>
    </div>
    <!-- Actual Menu Entries -->
    <ul class="menu hideMobileCollapsed">
        <!-- About Me -->
        <?php if(!is_front_page()): ?>
            <li>
                <a href="<?php echo $aboutMeLink; ?>" title="About me / contact" class="modal-trigger" target="<?php echo $aboutMeTarget; ?>" ga-on="click" ga-event-category="Social" ga-event-label="About Me Click">
                    <span class="largest">About / Contact</span>
                    <span class="smaller">❔ / Contact</span>
                </a>
            </li>
        <?php endif; ?>
        <!-- Projects -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle='dropdown' href='#'>Projects</a>
            <ul class="dropdownMenu">
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
            <a href="/custom-tools/">Mini Tools</a>
        </li>
        <li>
            <a href="/blog/">Blog</a>
        </li>
        <div class="navSearchWrapper">
            <div class="siteSearchWrapper">
                <form id="siteSearchForm">
                    <input type="text" class="siteSearchInput" autocomplete="off" placeholder="search" aria-label="Site search box" />
                </form>
            </div>
        </div>
    </ul>
</nav>

<style>
.jtNavBar {
    position: fixed;
    top: 0px;
    z-index: 99;
}
.jtNavBar, .jtNavBar .menu > .dropdown, .siteSearchInput, .jtNavBar .dropdownMenu {
    background-color: var(--color-primary);
    color: var(--color-on-primary);
}
.jtNavBar[data-collapsed="false"] .jtCollapsed {
    display: none;
}
.jtNavBar .dropdown {
    position: relative;
}
.jtNavBar .dropdownMenu {
    display: none;
    border-top: 2px solid #F69087;
    position: absolute;
    top: 100%;
    left: 0px;
    z-index: 99;
    min-width: 160px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.jtNavBar .title {
    font-size: 1.8rem;
    float: left;
    padding-left: 4px;
    padding-right: 6px;
    margin-right: 2px;
    border-right: 1px solid rgba(255, 255, 255, 0.3);
}
.jtNavBar ul.menu {
    display: inline-block;
    width: 78%;
    text-align: center;
}
.jtNavBar ul.menu > li {
    display: block;
    padding: 0px 10px !important;
}
.jtNavBar ul li:hover {
    background-color: rgba(252, 252, 252, 0.10) !important;
}
.jtNavBar ul li a:hover {
    background-color: unset;
}
/** Show collapsed dropdown menus on hover, or when JS adds attribute */
.jtNavBar .dropdown:hover .dropdownMenu, .jtNavBar .dropdown[data-expanded="true"] .dropdownMenu {
    display: block;
}
.jtNavBar .dropdownMenu li.dropdown {
    width: 100%;
}

.jtNavBar .navToggle {
    float: left;
    width: 40px;
    height: 40px;
    background-color: var(--color-primary);
    color: var(--color-on-primary);
    fill: var(--color-on-primary);
    margin: 10px 10px 0px 10px;
    border: 2px solid var(--color-secondary);
    border-radius: 8px;
}

.jtNavBar .hideFull {
    display: none;
}

.jtNavBar .navSearchWrapper {
    overflow: hidden;
}
.jtNavBar .navSearchWrapper .siteSearchWrapper {
    max-width: 250px;
    text-align: center;
    margin: auto;
}
.jtNavBar .smaller {
    display: none;
}
.jtNavBar .emoji {
    font-size: 1.6rem;
}

@media (max-width: 800px) {
    .jtNavBar .largest {
        display: none;
    }
    .jtNavBar .smaller {
        display: inherit;
    }
    .jtNavBar .title {
        font-size: 1.3rem;
        padding-right: 4px;
    }
    .jtNavBar ul a {
        padding: 0px 4px;
    }
}

/* Still full menu, but shrink things a little */
@media (max-width: 720px) {
    .jtNavBar .title {
        font-size: 1.1rem;
        padding-right: 3px;
    }
}

/* Swap from regular menu to collapse-able hamburger menu */
@media (max-width: 650px) {
    .jtNavBar ul.menu {
        text-align: left;
    }
    .jtNavBar .title {
        font-size: 1.6rem;
        text-align: center;
        width: calc(100% - 80px);
        border-right: none;
    }
    .jtNavBar[data-collapsed="false"] .hideMobileCollapsed {
        display: none;
    }
    .jtNavBar .hideFull {
        display: unset;
    }
    .jtNavBar ul.menu {
        width: 100%;
        background-color: var(--color-primary);
        color: var(--color-on-primary);
    }
    .jtNavBar ul.menu li {
        width: 100%;
        padding-left: 20px;
    }
    .jtNavBar .dropdownMenu {
        position: relative;
    }
    .jtNavBar .dropdownMenu li.dropdown {
        margin-left: 12px;
    }
}
</style>

<script>
(() => {
    /** @type {HTMLDivElement} */
    const navBar = document.querySelector('.jtNavBar');
    let navIsOpen = false;
    document.querySelector('.jtNavBar .navToggle').addEventListener('click', () => {
        navIsOpen = !navIsOpen;
        navBar.setAttribute('data-collapsed', navIsOpen);
    });
})()
</script>

<!-- Load Business Card -->
<div id="businessCardMaterializeModal" class=" businessCardMaterializeModal modal" data-opacity="0.9">
    <div class="modal-content">
        <?php get_template_part('partials/about-me-card'); ?>
        <?php get_template_part('partials/business-card-materialize'); ?>
    </div>
</div>