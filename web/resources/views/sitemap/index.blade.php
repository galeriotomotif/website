<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($datas as $item)
    <sitemap>
        <loc>{{ $item->loc }}</loc>
        <lastmod>{{ $item->last_mod }}</lastmod>
    </sitemap>
    @endforeach
</sitemapindex>
