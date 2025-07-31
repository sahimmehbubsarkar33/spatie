<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    public function display(){

        $permissions = Permission::all();
            return view('permissions.display',compact('permissions'));
    }

    public function createPage(){
        return view('permissions.create');
    }
    public function create(Request $request){
           $validate = $request->validate([
            'name' =>"required|unique:permissions|min:3",
           ]);
           $permission = Permission::create([
            'name'=>$request->name
           ]);
           if($permission){
            return redirect()->route('permissions.display');
           }

    }
    public function edit($id){
       $permissions = Permission::findOrFail($id);
        return view('permissions.edit',compact("permissions"));
    }
    public function  update(Request $request , $id){
          $validate = $request->validate([
            'name' =>"required|unique:permissions|min:3",
           ]);
           $permission =Permission::findOrFail($id);
           $permission->name = $request->name ?? "";
           $permission->update();
           if($permission){
            return redirect()->route('permissions.display');
           }
    }
    public function delete($id){
        $permissions = Permission::findOrFail($id);
        $permissions->delete();
        if($permissions){
            return redirect()->route('permissions.display');
        }
    }
}
