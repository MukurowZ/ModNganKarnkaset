<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Department;
use Illuminate\Routing\Route;

class AdminController extends Controller
{
    // Contact
    public function contact(){ return view('contact.contact_report');}
    public function partner(){ return view('contact.partner_manager');}
    public function editPartner(){ return view('contact.partner_edit');}
    public function createPartner(){ return view('contact.partner_create');}

    // Category
    public function category(){ return view('product_service.category');}

    // Event Section
    public function event(){ return view('event.admin-event');}
    public function editEvent($id){ return view('event.edit-event', compact('id'));}
    public function createEvent(){ return view('event.create-event');}

    // Product
    public function product(){ return view('product_service.admin-product');}
    public function editProduct($id){ return view('product_service.edit-product', compact('id'));}
    public function createProduct(){ return view('product_service.create-product');}

    // User
    public function user(){ return view('user.manage-user');}
    public function createUser(){ return view('user.create-user');}
    public function editUser($id){ return view('user.edit-user',compact('id'));}

    // Department
    public function department(){ return view('user.manage-department');}

    // Init User
    public function init_user(){
        $a = User::get()->first();
        if($a==null){
            return view('user.create-user');
        }else{
            return view('welcome');
        }
    }
    
    // Init Department
    public function init_dept(){
        $a = Department::get()->first();
        if($a==null){
            return view('user.manage-department');
        }else{
            return view('welcome');
        }
    }


}
