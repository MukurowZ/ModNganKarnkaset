@extends('../core/core')
@section('title','จัดการหน่วยงาน')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <manager-menu-component></manager-menu-component>
        <department-creator-component></department-creator-component>
        <br>
        <department-manager-component></department-manager-component>
    </div>
</body>
@endsection
