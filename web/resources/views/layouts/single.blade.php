<!DOCTYPE html>
<html lang="en">

<head>

    @include('includes.head')
    @include('includes.styles')

    @stack('head')

    {!! \Helpers\StructureDataHelper::make(
    [
    'url' => $meta->url,
    'title' => $meta->title,
    'description' => $meta->description,
    'image' => $meta->image,
    'created_at' => $meta->created_at,
    'updated_at' => $meta->updated_at
    ]
    ) !!}

    @stack('styles')
</head>

<body>
    @include('includes.header')

    @include('includes.nav')

    <main class="single-post">
        @yield('content')
    </main>

    @include('includes.footer')

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
