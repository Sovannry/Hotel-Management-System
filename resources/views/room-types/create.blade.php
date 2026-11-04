@extends('layouts.app')
@section('title','Add Room Type') @section('page-heading','Add Room Type')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('room-types.store') }}">@csrf  @include('room-types._form')</form></div>@endsection
