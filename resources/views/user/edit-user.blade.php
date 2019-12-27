@extends('../core/core')
@section('title','แก้ไขข้อมูลผู้ดูแล')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <user-editor-component id="{{ $id }}"></user-editor-component>
    </div>
</body>
@endsection
