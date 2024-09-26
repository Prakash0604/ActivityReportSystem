<?php

namespace App\Services;

use App\Models\User;

class UserService{
    protected $modal;
    public function __construct(private User $user){
        $this->modal=$user;
    }

    public function fetchall(){
        $data=$this->modal->all();
        return $data;
    }

    public function storeUser(array $data){
       $data= $this->modal->create($data);
        return $data;
    }
}
