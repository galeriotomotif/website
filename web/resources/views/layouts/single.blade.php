<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <link rel="shortcut icon" href="{{asset('images/favicon/favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">

    <title>{{$post->meta->title}}</title>

    <link rel="canonical" href="{{str_replace('www.','',url()->full())}}" />

    <meta name="description" content="{{ $post->meta->description }}">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $post->meta->title }}">
    <meta itemprop="description" content="{{ $post->meta->description }}">
    <meta itemprop="image" content="{{ ($post->image ? url($post->image) : "") }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="" {{ $post->meta->title }}">
    <meta property="og:description" content="{{ $post->meta->description }}">
    <meta property="og:image" content="{{ ($post->image ? url($post->image) : "") }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta->title }}">
    <meta name="twitter:description" content="" {{ $post->meta->description }}">
    <meta name="twitter:image" content="{{ ($post->image ? url($post->image) : "") }}">

    @include('includes.styles')

    @stack('styles')
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

    <main class="single-post">
        @yield('content')
    </main>

    <footer>

    </footer>


    <script>
        function showMenu(){
            var menu = document.getElementById('menu');
            menu.classList.add('active');
        }

        function hideMenu(){
            var menu = document.getElementById('menu');
            menu.classList.remove('active');
        }
    </script>
</body>

</html>
