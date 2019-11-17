<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function initUser(UserRequest $request)
    {
        $a = User::get()->first();
        if($a==null){
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            return User::create($validated);
        }
        else return '';
    }

    public function initDept()
    {
        $a = User::get()->first();
        if($a==null){
            return Department::all();
        }
        else return '';
    }

}
