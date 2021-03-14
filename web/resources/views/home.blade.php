<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">

    <title>{{$page->meta->title}}</title>

    <link rel="canonical" href="{{str_replace('www.','',url()->full())}}" />

    <meta name="description" content="{{ $page->meta->description }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $page->meta->title }}">
    <meta itemprop="description" content="{{ $page->meta->description }}">
    <meta itemprop="image" content="{{ ($page->image ? url($page->image) : "") }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="" {{ $page->meta->title }}">
    <meta property="og:description" content="{{ $page->meta->description }}">
    <meta property="og:image" content="{{ ($page->image ? url($page->image) : "") }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $page->meta->title }}">
    <meta name="twitter:description" content="" {{ $page->meta->description }}">
    <meta name="twitter:image" content="{{ ($page->image ? url($page->image) : "") }}">

    @include('includes.styles')
</head>

<body>

    <header>
        <div class="hamburger" onclick="showMenu()"></div>
        <div class="brand">
            <div class="logo">
                <img src="https://png.pngtree.com/png-clipart/20190604/original/pngtree-creative-company-logo-png-image_1420804.jpg"
                    alt="brand">
            </div>
            <div class="title">
                <a href="{{ url('') }}">
                    <h1>Busertrans Online</h1>
                </a>
            </div>
        </div>
    </header>

    <nav id="menu" class="menu">
        <div class="content">
            <div class="header">
                <span class="close-icon" onclick="hideMenu()"></span>
            </div>
            <div class="body">
                <ul>
                    <li class="active">
                        <a href="">Category 1</a>
                    </li>
                    <li>
                        <a href="">Category 2</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="home">
        <section class="headline">
            <div class="slider">
                @foreach ($headline as $item)
                <a href="{{ route('post.show', $item->slug) }}">
                    <div class="item">
                        <img src="{{ ($item->image ? url($item->image) : asset('images/no-image.jpg')) }}"
                            alt="{{$item->name}}">

                        <span class="title">{{$item->name}}</span>
                    </div>
                </a>
                @endforeach

                <div class="next-button arrow right" onclick="sliderNextItem()"></div>
            </div>
        </section>

        <section class="new-post">
            <div class="list">
                @foreach ($newPosts as $item)
                <a href="{{ route('post.show', $item->slug) }}">
                    <div class="item">
                        <div class="thumbnail">
                            <img src="{{ ($item->image ? url($item->image) : asset('images/no-image.jpg')) }}"
                                alt="item-1">
                        </div>

                        <div class="detail">
                            <span class="title">{{ $item->name }}</span>

                            <span class="date">{{ $item->published_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

    </main>

    <footer>

    </footer>

    @include('includes.scripts')
</body>

</html>
