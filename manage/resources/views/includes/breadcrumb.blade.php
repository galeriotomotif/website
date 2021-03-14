<nav aria-label="breadcrumb">
    <ol class="breadcrumb float-right bg-transparent">
        @foreach ($breadcrumb as $item)
            <li class="breadcrumb-item active" aria-current="{{ $item }}">{{ $item }}</li>
        @endforeach
    </ol>
</nav>
