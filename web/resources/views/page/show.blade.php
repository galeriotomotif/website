@extends('layouts.single')

@section('content')

<h1>{{ $page->name }}</h1>
<span class="date">{{ $page->published_at->format('d/m/Y H:i') }}</span>

<div class="content">
    {!! $page->content !!}
</div>

@endsection

@push('styles')

<style>

</style>

@endpush
