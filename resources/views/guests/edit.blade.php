@extends('layouts.app')
@section('title','Edit Guest') @section('page-heading','Edit Guest')
@section('content')<div class="panel form-panel"><form method="POST" action="{{ route('guests.update',$guest) }}">@csrf @method("PUT") @include('guests._form')</form></div>@endsection
