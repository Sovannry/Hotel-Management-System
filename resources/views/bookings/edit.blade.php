@extends('layouts.app')
@section('title','Edit Booking') @section('page-heading','Edit Booking')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('bookings.update',$booking) }}">@csrf @method("PUT") @include('bookings._form')</form></div>@endsection
