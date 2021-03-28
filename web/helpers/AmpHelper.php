<?php

namespace Helpers;

class AmpHelper
{
    public static function makeAmpUrl($url)
    {
        $baseUrl = url('');

        return str_replace($baseUrl, $baseUrl . '/amp', $url);
    }
    public static function optimize($content)
    {
        // $content=AmpHelper::generateAdsInArticle($content);
        $content = AmpHelper::imageToAmpImage($content);
        return $content;
    }

    private static function imageToAmpImage($content)
    {
        $pattern = "/<img[^>]+>/i";
        preg_match_all($pattern, $content, $images);

        foreach ($images[0] as $image) {
            $ampImage = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $image);
            $ampImage = $ampImage . "</amp-img>";
            $ampImage = str_replace('<img', '<amp-img width="16" height="9" layout="responsive"', $ampImage);
            $content = str_replace($image, $ampImage, $content);
        }

        return $content;
    }
}
