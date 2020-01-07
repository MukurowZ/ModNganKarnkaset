@extends('../core/core')
@section('title','กิจกรรมทั้งหมด')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <show-event-component></show-event-component>
    </div>
</body>
@endsection
