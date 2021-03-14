<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        @include('includes.sidebar')
        <main class="page-content">
            @include('includes.header')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-none d-md-block">
                            @include('includes.breadcrumb')
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </main>
        <!-- page-content" -->

        @include('includes.modal')
        <div id="lfm-init" data-route-prefix="{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}"
            data-csrf-token="{{csrf_token()}}"></div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
