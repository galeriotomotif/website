<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">

<title>{{$meta->title}}</title>

<link rel="canonical" href="{{str_replace('www.','',url()->full())}}" />

<meta name="description" content="{{ $meta->description }}">

<!-- Google / Search Engine Tags -->
<meta itemprop="name" content="{{ $meta->title }}">
<meta itemprop="description" content="{{ $meta->description }}">
<meta itemprop="image" content="{{ $meta->image }}">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="{{url()->full()}}">
<meta property="og:type" content="website">
<meta property="og:title" content="" {{ $meta->title }}">
<meta property="og:description" content="{{ $meta->description }}">
<meta property="og:image" content="{{ $meta->image }}">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta->title }}">
<meta name="twitter:description" content="" {{ $meta->description }}">
<meta name="twitter:image" content="{{ $meta->image }}">
