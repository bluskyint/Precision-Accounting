<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

trait SEOTrait
{
    protected function dynamicPagesSeo( $post ){

        SEOMeta::setTitle($post->seo_title);
        SEOMeta::setDescription($post->seo_description);
        SEOMeta::setKeywords($post->seo_keywords);
        SEOMeta::addMeta('robots', $post->seo_robots);

        OpenGraph::addProperty('locale', 'en-US');
        OpenGraph::setType($post->og_type);
        OpenGraph::setTitle($post->og_title);
        OpenGraph::setDescription($post->seo_description);
        OpenGraph::setUrl(request()->url());
        OpenGraph::setSiteName(env('APP_NAME'));
        OpenGraph::addProperty('updated_time', $post->updated_at);

    }

    protected function StaticPagesSeo( $pageName , $description , $keywords ){

        SEOMeta::setTitle($pageName);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keywords);

    }
}
