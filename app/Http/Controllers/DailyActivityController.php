<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyActivityController extends Controller
{

    protected $model;

    public function __construct(TaskService $taskService){
        $this->model=$taskService;
    }
    public function index(){
        $tasks=Task::with(['taskDetail','createdBy'])->where('created_by',Auth::id())->get();
        return view('DailyTask.index',compact('tasks'));
    }

    public function store(Request $request){
        try{

           $validatedata= $request->validate([
                'title'=>'required|min:4',
                'starting_date'=>'required|date',
                'due_date'=>'nullable',
                'note'=>'nullable',
                'remarks'=>'nullable',
                'assignment'=>'required',
            ]);
            $validatedata['created_by']=Auth::id();
            $data=$this->model->storeTask($validatedata);
            if($data){

                foreach($validatedata['assignment'] as $index=>$assignment){
                    TaskDetail::create([
                        'task_id'=>$data->id,
                        'assignment'=>$assignment,
                        'remarks'=>$validatedata['remarks'][$index],
                        'status'=>$request['status'][$index]
                    ]);
                }
            }
            return response()->json(['success' => true, 'message' => 'Task and details stored successfully.']);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
        // dd($request->all());

    }


}
