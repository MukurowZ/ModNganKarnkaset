@extends('../core/core')
@section('title','จัดการหน่วยงาน')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <create-department-component></create-department-component>
        <manage-department-component></manage-department-component>
    </div>
</body>
@endsection
