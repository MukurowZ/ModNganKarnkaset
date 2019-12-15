@extends('../core/core')
@section('title','ผลงานและกิจกรรม')

@section('content')
<body>
<div id="app">
    <single-event-component :id="{{ $id }}" ></single-event-component>
</div>
</body>
@endsection
