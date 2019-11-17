@extends('../core/core')
@section('title','แก้ไขกิจกรรม')

@section('content')
    <div id="app">
        <edit-event-component id="{{ $id }}"></edit-event-component>
    </div>
    @include('../core/core_upload')
@endsection
