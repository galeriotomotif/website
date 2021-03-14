@extends('layouts.manage')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route($route.'store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row mb-1">
                <div class="col-sm-2">
                    <div class="image-wrapper">
                        <div class="lfm-image-preview" style="--image:url('{{ asset('images/no-image.png') }}')"></div>
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
                                value="{{ old('image') }}" placeholder="Chose the image"
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
                    name="name" value="{{ old('name') }}" placeholder="Enter the name" autofocus>

                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            @include('includes.meta-field')

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="published" value="1"
                        {{ (old('published') ? 'checked' : '') }}>
                    <label class="form-check-label" for="">Publish</label>
                </div>
                <small class="form-text text-muted">Check if you want to published</small>
            </div>

            <div class="form-group">
                <label for="">Content </label>

                @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <textarea name="content" class="summernote">{{ old('content') }}</textarea>
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
