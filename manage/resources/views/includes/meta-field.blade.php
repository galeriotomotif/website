<div class="form-group">
    <label for="">Meta Title</label>

    <input id="meta_title" type="text" class="form-control form-control-sm @error('meta_title') is-invalid @enderror"
        name="meta_title" value="{{ (old('meta_title') ? old('meta_title') : (isset($data) ? $data->title : old('meta_title') ) ) }}"
        placeholder="Enter the meta title">

    @error('meta_title')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

<div class="form-group">
    <label for="">Meta Description</label>

    <textarea name="meta_description" id="meta_description" class="form-control form-control-sm"
        rows="3" placeholder="Enter the meta description">{{ (old('meta_description') ? old('meta_description') : (isset($data) ? $data->description : old('meta_description') ) ) }}</textarea>

    @error('meta_description')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
