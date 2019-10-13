<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;

class AdminController extends Controller
{
    public function contact(){ return view('contact.contact_report');}

    // Event Section
    public function event(){ return view('event.admin-event');}
    public function editEvent($id){ return view('event.edit-event', compact('id'));}
    public function createEvent(){ return view('event.create-event');}

    // Product
    public function product(){ return view('product_service.admin-product');}
    public function editProduct($id){ return view('product_service.edit-product', compact('id'));}
    public function createProduct(){ return view('product_service.create-product');}

    public function manage(){ return view('user.user-manage');}
    public function user(){ return view('user.allUser');}
    public function createUser(){ return view('user.create-user');}
    public function editUser($id){ return view('user.edit-user',compact('id'));}

    public function createDepartment(){ return view('user.create-department');}

}
