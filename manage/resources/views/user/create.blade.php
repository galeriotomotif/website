@extends('layouts.manage')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route($route.'store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row mb-1">
                <div class="col-sm-2">
                    <div class="avatar-wrapper">
                        <img id="holder" class=""
                            src="{{ (old('avatar') ? url(old('avatar')) : asset('images/no-avatar.png')) }}">
                    </div>
                </div>

                <div class="col-sm-10">
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a data-input="avatar" data-preview="holder"
                                    class="btn btn-dark btn-sm text-white mr-1 lfm-field">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>

                            <input id="avatar" type="text"
                                class="form-control form-control-sm @error('avatar') is-invalid @enderror" name="avatar"
                                value="{{ old('avatar') }}" placeholder="Chose the avatar" readonly>
                        </div>

                        @error('avatar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="">Roles </label>

                <select name="roles[]" id="roles" class="select2 form-control @error('roles') is-invalid @enderror"
                    multiple>
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>

                @error('roles')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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

            <div class="form-group">
                <label for="">Email </label>

                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" placeholder="Enter the email">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Password</label>

                <input id="password" type="password"
                    class="form-control form-control-sm @error('password') is-invalid @enderror" name="password"
                    placeholder="Enter the password">

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Comfirm Password</label>

                <input id="password-confirm" type="password"
                    class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" placeholder="Enter the password comfirmation">

                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
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
