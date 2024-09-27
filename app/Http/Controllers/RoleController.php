<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $model;
    public function __construct(RoleService $roleService){
        $this->model=$roleService;
    }
    public function index(){
        $roles=Role::where('status',1)->get();
        return view('Role.index',compact('roles'));
    }

    public function store(Request $request){
        try{
           $data= $request->validate([
                'role'=>'required|unique:roles,role|min:3'
           ],
           [
            'role.unique'=>'Duplicate Role',
            'role.required'=>'Role name is required'
           ]);
            $this->model->storeData($data);
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function getRole($id){
        try{
            $role=Role::find($id);
            return response()->json(['success'=>true,'message'=>$role]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function update(Request $request,$id){
        try{
            $data=$request->validate([
                'role'=>'required|min:3',
            ]);
            $this->model->updateData($data,$id);
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function destory($id){
        try{
            $this->model->deleteData($id);
            return response()->json(['success'=>true]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

}
