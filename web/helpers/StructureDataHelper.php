<?php

namespace Helpers;

class StructureDataHelper
{
    public static function make($data = [
        'title' => null,
        'description' => null,
        'url' => null,
        'image' => null,
        'updated_at' => null,
        'created_at' => null
    ])
    {
        $baseUrl = url('');
        $data['image'] = str_replace($baseUrl . '/', '', $data['image']);

        $string = '<script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "mainEntityOfPage": {
          "@type": "WebPage",
          "@id": "' . $data['url'] . '"
        },
        "headline": "' . $data['title'] . '",
        "image": [
            "' . url('photos/1x1/' . $data['image']) . '",
            "' . url('photos/4x3/' . $data['image']) . '",
            "' . url('photos/16x9/' . $data['image']) . '"
          ],
        "datePublished": "' . $data['created_at'] . '",
        "dateModified": "' . $data['updated_at'] . '",
        "author": {
          "@type": "Person",
          "name": "infotransportasi.com"
        },
          "publisher": {
          "@type": "Organization",
          "name": "' . env('SITE_NAME', 'infotransportasi.com') . '",
          "logo": {
            "@type": "ImageObject",
            "url": "' . asset('images/logo.png') . '"
          }
        },
        "description": "' . $data['description'] . '"
      }
      </script>';

        return $string;
    }
}
