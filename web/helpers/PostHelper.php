<?php

namespace Helpers;

class PostHelper
{
    public static function optimize($content)
    {
        // $content=AmpHelper::generateAdsInArticle($content);
        $content = self::stripStyle($content);
        return $content;
    }

    private static function stripStyle($content)
    {
        $pattern = "/<img[^>]+>/i";
        preg_match_all($pattern, $content, $images);

        foreach ($images[0] as $image) {
            $newImage = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $image);
            $content = str_replace($image, $newImage, $content);
        }

        return $content;
    }
}
