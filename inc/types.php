<?php
/**
 * @file Any code in this file should be used purely for type annotations and inference, not for actual run-time
 */
?>

<?php

/**
 * @see JtzwpHelpers->getBasicPostInfo
 */
class BasicPostInfo {
    /** @var mixed */
    public $postObj;

    /** @var int|mixed */
    public $id;

    /** @var int|mixed */
    public $ID;

    /** @var string */
    public $permalink;

    /** @var bool */
    public $permalinkIsExternal;

    /** @var string */
    public $title;

    /** @var mixed */
    public $excerpt;

    /** @var bool */
    public $hasExcerpt;

    /** @var FeaturedImageInfo */
    public $featuredImage;

    /** @var string|false */
    public $templateSlug;

    /** @var PostDateInfo */
    public $date;

    /** @var PostOrganizationalInfo */
    public $org;
}

class FeaturedImageInfo {
    /** @var bool */
    public $hasFeaturedImage;
    /** @var bool */
    public $hasShadow;
}

class PostDateInfo {
    /** @var DateTime */
    public $published;
    /** @var PostAgeInfo */
    public $age;
}

class PostAgeInfo {
    /** @var mixed */
    public $days;
    /** @var mixed */
    public $months;
    /** @var mixed */
    public $years;
}

class PostOrganizationalInfo {
    public $isCustomPostType;
    /** @var string|false */
    public $postType;
    /** @var string */
    public $postTypeSingular;
}