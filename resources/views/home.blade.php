@extends('layouts.app')

@section('content')
<div class="container">
    <dashboard-container token="{{Auth::user()->api_token}}" ></dashboard-container>
</div>

@endsection
