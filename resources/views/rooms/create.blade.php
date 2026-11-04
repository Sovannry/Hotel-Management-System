@extends('layouts.app')
@section('title','Add Room') @section('page-heading','Add Room')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('rooms.store') }}">@csrf  @include('rooms._form')</form></div>@endsection
