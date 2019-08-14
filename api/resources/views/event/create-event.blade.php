@extends('../core/core')
@section('title','เพิ่มกิจกรรม')

@section('content')
<body>
<div id="app" class="d-inline-flex">
    <create-event-component></create-event-component>
</div>

@include('../core/core_upload')

</body>
</html>
@endsection
