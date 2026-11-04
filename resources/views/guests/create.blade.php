@extends('layouts.app')
@section('title','Add Guest') @section('page-heading','Add Guest')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('guests.store') }}">@csrf  @include('guests._form')</form></div>@endsection
