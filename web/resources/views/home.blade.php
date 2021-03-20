<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    @include('includes.styles')
</head>

<body>
    @include('includes.header')
    @include('includes.nav')

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

    @include('includes.footer')
    @include('includes.scripts')
</body>

</html>
