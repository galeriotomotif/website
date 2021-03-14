@extends('layouts.manage')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route($route.'update', $category->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-1">
                <div class="col-sm-2">
                    <div class="image-wrapper">
                        <div class="lfm-image-preview"
                            style="--image:url('{{ ($category->image? url($category->image) : asset('images/no-image.png') ) }}')">
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
                                value="{{ ($category->image ? $category->image : old('image')) }}"
                                placeholder="Chose the image" onchange="window.imageFieldChanged('{{url('')}}',this)"
                                readonly>
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
                    name="name"
                    value="{{ (old('name') ? old('name') : ($category->name ? $category->name : old('name') ) ) }}"
                    placeholder="Enter the name" autofocus>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @if ($category->published_at)
            <div class="form-group">
                <label for="">Slug : {{ $category->slug }}</label>

                <input id="slug" type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror"
                    name="slug" placeholder="Enter the slug" autofocus>

                @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @endif

            @include('includes.meta-field',[
            'data' => $category->meta
            ])

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="published" value="1"
                        {{ (old('published') ? 'checked' : ($category->published_at ? 'checked': '')) }}>
                    <label class="form-check-label" for="">Publish</label>
                </div>

                @if ($category->published_at)
                <small class="form-text text-muted">Published at
                    {{ $category->published_at->format('d/m/Y H:i') }}</small>
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
                    class="summernote">{{ (old('content') ? old('content') : ($category->content ? $category->content : old('content') ) ) }}</textarea>
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
