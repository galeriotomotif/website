@extends('layouts.manage')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{route($route.'create')}}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top"
            title="Create a new {{$title}}">Create {{$title}}</a>
    </div>
    <div class="card-body">
        @include($view.'datatables')
    </div>
</div>

@endsection
