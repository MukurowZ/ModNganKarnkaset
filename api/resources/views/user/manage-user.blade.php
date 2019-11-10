@extends('../core/core')
@section('title','เพิ่มผู้ใช้')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <manager-menu-component></manager-menu-component>
        <user-manager-component></user-manager-component>
    </div>
</body>
@endsection
