<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\SEOMeta;

trait SEOTrait
{
    protected function dynamicPagesSeo( $post ){

        SEOMeta::setTitle($post->seo_title);
        SEOMeta::setDescription($post->seo_description);
        SEOMeta::setKeywords($post->seo_keywords);

    }

    protected function StaticPagesSeo( $pageName , $description , $keywords ){

        SEOMeta::setTitle($pageName);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

    }
}
