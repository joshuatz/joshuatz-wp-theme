<?php
/**
 * Materialize styled business card
 */
?>
<?php
/**
 * Preprocessing
 */
    global $jtzwpHelpers;
    $age = false;
    $birthday = $jtzwpHelpers->getThemeUserSetting('jtzwp_about_me_birthdate');
    if ($birthday->isValid){
        $birthdayDateTime = new DateTime($birthday->val);
        $now = new DateTime('now');
        $ageDiff = date_diff($birthdayDateTime,$now,true);
        $age = $jtzwpHelpers->getDateDiffByUnit($ageDiff,'years');
    }
?>
<div class="businessCard materialize">
    <div class="background">
        <div class="diagonals"></div>
    </div>
    <div class="card-panel z-depth-4 hoverable">
        <div class="row valign-wrapper">
            <div class="col s8 leftSide">
                <div class="row nameAndTitleSection">
                    <div class="fullName col s12">Mr. Joshua Tzucker</div>
                    <div class="divider col s12" style="height: 2px;"></div>
                    <div class="jobTitle col s11 offset-s1">Professional Tinkerer</div>
                </div>
                <div class="row">
                    <div class="col s11 offset-s1 linksAndDetailsSection">
                        <div class="emailAddress col s12 valign-wrapper">
                            <div class="iconWrapper z-depth-2 iconsSolidBackground">
                                <div class="icon">
                                    <i class="material-icons left">email</i>
                                </div>
                            </div>
                            <div class="textWrapper">
                                <a href="mailto:email@example.com?subject=I%20Found%20Your%20Website" target="_blank">email@example.com</a>
                            </div>
                        </div>
                        <div class="rowJoinerWrapper"><div class="rowJoiner iconsSolidBackground"></div></div>
                        <div class="geography col s12 valign-wrapper">
                            <div class="iconWrapper z-depth-2 iconsSolidBackground">
                                <div class="icon">
                                    <i class="material-icons left">map</i>
                                </div>
                            </div>
                            <div class="textWrapper">
                                <span>Greater Seattle Area</span>
                            </div>
                        </div>
                        <div class="rowJoinerWrapper"><div class="rowJoiner iconsSolidBackground"></div></div>
                        <div class="linkedInURL col s12 valign-wrapper">
                            <div class="iconWrapper z-depth-2 iconsSolidBackground">
                                <div class="icon">
                                    <i class="material-icons left">link</i><i class="fa fa-linkedin-square iconsSolidBackground" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="textWrapper">
                                <a href="https://www.linkedin.com/in/joshuatzucker" target="_blank">LinkedIn</a>
                            </div>
                        </div>
                        <div class="rowJoinerWrapper"><div class="rowJoiner iconsSolidBackground"></div></div>
                        <div class="codingProfileURL col s12 valign-wrapper">
                            <div class="iconWrapper z-depth-2 iconsSolidBackground">
                                <div class="icon">
                                    <i class="material-icons left">code</i><i class="fa fa-github iconsSolidBackground" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="textWrapper">
                                <a href="https://github.com/joshuatz" target="_blank">Github</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s4 rightSide">
                <div class="valign-wrapper">
                    <div class="profilePictureWrapper col s12 z-depth-2">
                        <img class="profilePicture responsive-img" src="/wp-content/uploads/favicon3.png">
                    </div>
                </div>
                <?php if ($age): ?>
                    <div class="ageWrapper col s12 center">
                        <span>Age <?php echo $age; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>