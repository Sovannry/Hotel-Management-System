@extends('layouts.app')
@section('title','Edit Room') @section('page-heading','Edit Room')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('rooms.update',$room) }}">@csrf @method("PUT") @include('rooms._form')</form></div>@endsection
