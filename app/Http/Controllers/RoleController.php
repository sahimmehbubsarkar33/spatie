<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function display(){
        $roles = Role::latest()->get();
        return view('roles.display', compact('roles'));
    }
    public function createPage(){
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('roles.create',compact('permissions'));
    }
    public function create(Request $request){
        $validate = $request->validate([
            'name'=>"required|unique:roles|min:2",
             'permission' => 'nullable|array',
        ]);
        $roles = Role::create([
            "name" => $request->name ?? " "
        ]);

        if(!empty($request->permission)){
            foreach($request->permission as $name ){
                $roles->givePermissionTo($name);
            }
        }
        if($roles){
            return redirect()->route('roles.display');

        }
        else{
            return redirect()->route('roles.create');
        }
    }
 
    public function edit($id){
        $role = Role::findOrFail($id);
        $hasPermissions = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();

        return view('roles.edit',compact('role','hasPermissions','permissions'));
    }
   public function update(Request $request, $id)
{
    // Validate role name
    $request->validate([
        'name' => 'required|min:2|unique:roles,name,' . $id, // ignore current role for uniqueness
    ]);

    // Find the role
    $role = Role::findOrFail($id);

    // Update the role's name
    $role->name = $request->name;
    $role->save();

    // Sync permissions (empty array if none checked)
    $role->syncPermissions($request->permission ?? []);

    return redirect()->route('roles.display')->with('success', 'Role updated successfully!');
}

public function delete($id)
{
    $role = Role::findOrFail($id);
    $role->syncPermissions([]); // optional cleanup
    $role->delete();

    return redirect()->route('roles.display')->with('success', 'Role deleted successfully.');
}

}
