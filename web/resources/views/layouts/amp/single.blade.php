<!DOCTYPE html>
<html amp lang="en">

<head>

    @include('includes.amp.head')
    @include('includes.styles')

    @stack('styles')
</head>

<body class="amp-body">
    @include('includes.amp.header')
    @include('includes.amp.nav')

    <main class="single-post">
        @yield('content')
    </main>

    @include('includes.footer')
</body>

</html>
