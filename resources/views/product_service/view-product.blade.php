@extends('../core/core')
@section('title','สินค้า และบริการ')

@section('content')
<body>
<div id="app">
    <view-product-component id='{{ $id }}'></view-product-component>
</div>
</body>

@endsection
