<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Category;
use App\Model\Service;

class SearchController extends Controller
{
    public function search(Request $request){
        $search = $request->get('q');
        $service = Service::where('name','like','%'.$search.'%')->get();
        $product = Product::where('name','like','%'.$search.'%')->get();
        $result = json_encode(array_merge(json_decode($service, true),json_decode($product, true)));
        return $result;
    }

    public function searchByType(Request $request){
        $search = $request->get('q');
        $search = Category::where('name',$search)->first()->only(['id']);
        $service = Service::where('type',$search['id'])->get();
        $product = Product::where('type',$search['id'])->get();
        $result = json_encode(array_merge(json_decode($service, true),json_decode($product, true)));
        return $result;
    }
}
