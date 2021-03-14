@extends('layouts.manage')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route($route.'update', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-1">
                <div class="col-sm-2">
                    <div class="image-wrapper">
                        <div class="lfm-image-preview"
                            style="--image:url('{{ ($post->image? url($post->image) : asset('images/no-image.png') ) }}')">
                        </div>
                    </div>
                </div>

                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="image" class="btn btn-dark btn-sm text-white mr-1 lfm-field">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>

                            <input id="image" type="text"
                                class="form-control form-control-sm @error('image') is-invalid @enderror" name="image"
                                value="{{ ($post->image ? $post->image : old('image')) }}" placeholder="Chose the image"
                                onchange="window.imageFieldChanged('{{url('')}}',this)" readonly>
                        </div>

                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Name </label>

                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                    name="name" value="{{ (old('name') ? old('name') : ($post->name ? $post->name : old('name') ) ) }}"
                    placeholder="Enter the name" autofocus>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @if ($post->published_at)
            <div class="form-group">
                <label for="">Slug : {{ $post->slug }}</label>

                <input id="slug" type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror"
                    name="slug" placeholder="Enter the slug" autofocus>

                @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif

            <div class="form-group">
                <label for="">Category </label>

                <select name="category_id" id="category_id" class="selectpicker form-control form-control-sm">
                    <option value="">Select a category</option>
                    @foreach ($categories as $item)
                    <option value="{{$item->id}}"
                        {{ (old('category_id') == $item->id ? 'selected':($post->category_id==$item->id ? 'selected' : '')) }}>
                        {{$item->name}}</option>
                    @endforeach
                </select>

                @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Tags </label>

                <select name="tags[]" id="tags" class="selectpicker form-control form-control-sm" multiple>
                    @foreach ($tags as $item)
                    <option value="{{$item->id}}"
                        {{ (is_array(old('tags')) ? ( in_array($item->id, old('tags') ) ? 'selected' : '' ) : (in_array($item->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' )) }}>
                        {{$item->name}}</option>
                    @endforeach
                </select>

                @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @include('includes.meta-field',[
            'data' => $post->meta
            ])

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="published" value="1"
                        {{ (old('published') ? 'checked' : ($post->published_at ? 'checked': '')) }}>
                    <label class="form-check-label" for="">Publish</label>
                </div>

                @if ($post->published_at)
                <small class="form-text text-muted">Published at
                    {{ $post->published_at->format('d/m/Y H:i') }}</small>
                @else
                <small class="form-text text-muted">Check if you want to published</small>
                @endif
            </div>

            <div class="form-group">
                <label for="">Content </label>

                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <textarea name="content"
                    class="summernote">{{ (old('content') ? old('content') : ($post->content ? $post->content : old('content') ) ) }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark btn-sm" data-toggle="tooltip" data-placement="top"
                    title="Save data"><i class="fas fa-save mr-1"></i>Save</button>
                <a href="{{ route($route.'index') }}" class="btn btn-default btn-sm" data-toggle="tooltip"
                    data-placement="top" title="Back to list data"><i class="fas fa-backspace mr-1"></i>Back</a>
            </div>
        </form>
    </div>
</div>

@endsection
