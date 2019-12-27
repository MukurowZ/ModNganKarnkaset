@extends('../core/core')
@section('title','จัดการหมวดหมู่สินค้า')
@section('navbar')
@parent


@endsection
@section('content')
<body>
    <div id="app">
        <category-creator-component></category-creator-component>
        <br>
        <category-manager-component></category-manager-component>
    </div>
</body>
@endsection
