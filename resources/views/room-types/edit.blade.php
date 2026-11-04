@extends('layouts.app')
@section('title','Edit Room Type') @section('page-heading','Edit Room Type')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('room-types.update',$roomType) }}">@csrf @method("PUT") @include('room-types._form')</form></div>@endsection
