@extends('../core/core')
@section('title','แก้ไขสินค้า/บริการ')

@section('content')
    <div id="app">
        <edit-product-component id="{{ $id }}"></edit-event-component>
    </div>
    @include('../core/core_upload')
@endsection
