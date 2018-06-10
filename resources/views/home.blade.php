@extends('layouts.app')

@section('content')
<div class="container">
    <dashboard-container user="{{Auth::user()->id}}" ></dashboard-container>
</div>

@endsection
