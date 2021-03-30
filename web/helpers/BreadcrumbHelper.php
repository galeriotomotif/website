<?php

namespace Helpers;

use Illuminate\Support\Facades\Request;

class BreadcrumbHelper
{
    public static function make($url = null)
    {
        if (!$url) {
            $url = Request::path();
        }

        $url = str_replace('amp/', '', $url);
        $breadcrumb = '<script type="application/ld+json">{"@context": "https://schema.org","@type": "BreadcrumbList","itemListElement": [';

        $numberOfContent = 1;

        if (strlen($url) != 1) {

            $url = explode("/", $url);

            $last_key_url = array_key_last($url);

            for ($i = 0; $i < count($url); $i++) {

                if ($url[$i] != "page") {

                    $breadcrumb .= '{';
                    $breadcrumb .= '"@type": "ListItem",';
                    $breadcrumb .= '"position": ' . $numberOfContent . ',';
                    $numberOfContent++;
                    $breadcrumb .= '"name": "' . $url[$i] . '",';
                    $breadcrumb .= '"item": "';
                    $breadcrumb .= url('');

                    for ($y = 0; $y <= $i; $y++) {

                        $breadcrumb .= "/" . $url[$y];
                    }

                    $breadcrumb .= '"}';

                    // make tag <a>
                    if ($i != $last_key_url) {
                        $breadcrumb .= ',';
                    }
                    // end make tag <a>
                }
            }
        }

        $breadcrumb .= ']';
        $breadcrumb .= "}";

        $breadcrumb .= "</script>";

        return $breadcrumb;
    }
}
