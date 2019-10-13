@extends('../core/core')
@section('title','กิจกรรมทั้งหมด')
@section('navbar')
@parent


@endsection
@section('content')
<script src="{{ asset('js/script.js') }}"></script>
<body>
    <div id="app">
        <show-event-component></show-event-component>
    </div>
</body>

<script>

</script>
@endsection
