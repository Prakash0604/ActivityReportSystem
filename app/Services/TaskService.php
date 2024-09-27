<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService{
    protected $model;
    public function __construct(private Task $task){
        $this->model=$task;
    }

    public function storeTask(array $data){
        $data=$this->model->create($data);
        return $data;
    }
}
