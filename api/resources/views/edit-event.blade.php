@extends('core')
@section('title','กิจกรรมทั้งหมด')
@section('navbar')
@parent


@endsection
@section('content')
    <div id="app">
        <edit-event-component id="'{{ $id }}''"></edit-event-component>
    </div>
@endsection
