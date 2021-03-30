@extends('layouts.single')

@section('content')

<h1>{{ $post->name }}</h1>
<span class="date">{{ $post->published_at->format('d/m/Y H:i') }}</span>
<div class="feature-image">
    <img src="{{url($post->image)}}" alt="">
</div>
<div class="content">
    {!! $post->content !!}
</div>

@endsection

@push('styles')

<style>

</style>

@endpush
