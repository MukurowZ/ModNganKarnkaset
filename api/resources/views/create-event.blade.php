@extends('core')
@section('title','เพิ่มกิจกรรม')
@section('navbar')
@parent


@endsection
@section('content')
<body>
<div id="app" class="d-inline-flex">
    <create-event-component></create-event-component>
</div>

@include('core_upload')

</body>
</html>
@endsection
