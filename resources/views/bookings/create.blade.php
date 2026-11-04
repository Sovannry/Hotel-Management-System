@extends('layouts.app')
@section('title','Create Booking') @section('page-heading','Create Booking')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('bookings.store') }}">@csrf  @include('bookings._form')</form></div>@endsection
