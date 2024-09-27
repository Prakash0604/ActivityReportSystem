<?php
namespace App\Services;

use App\Models\Role;

class RoleService{
    protected $model;
    public function __construct(private Role $role){
        $this->model=$role;
    }

    public function storeData(array $data){
        $this->model->create($data);
    }

    public function updateData(array $data,$id){
        $role=$this->model->find($id);
        $role->update($data);
    }

    public function deleteData($id){
        $data=$this->model->find($id);
        $data->delete();
    }
}
