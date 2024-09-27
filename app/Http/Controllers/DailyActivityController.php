<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskDetail;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyActivityController extends Controller
{

    protected $model;

    public function __construct(TaskService $taskService){
        $this->model=$taskService;
    }
    public function index(){
        if(Auth::user()->role_id==1){
            $tasks=Task::with(['taskDetail','createdBy'])->get();
            $tasksCount =DB::table('tasks')->join('task_details','task_details.task_id','tasks.id')
            ->where('task_details.status',0)->count();
        }else{
            $tasks=Task::with(['taskDetail','createdBy'])->where('created_by',Auth::id())->get();
            $tasksCount =DB::table('tasks')->join('task_details','task_details.task_id','tasks.id')
            ->where('task_details.status',0)->count();
        }
        return view('DailyTask.index',compact('tasks','tasksCount'));
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

    public function edit($id){
        try{

            $tasks=$this->model->taskEdit($id);
            $taskDetails=$tasks->taskDetail;
            return response()->json(['success'=>true,'message'=>$taskDetails,'tasks'=>$tasks]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }

    }

    public function update(Request $request,$id){
        try{


        $validatedata=$request->validate([
            'title'=>'required',
            'starting_date'=>'required|date',
            'due_date'=>'nullable',
            'note'=>'nullable',
            'assignment'=>'required'
        ]);
        $validatedata['updated_by']=Auth::id();
        $data=$this->model->updateTask($validatedata,$id);
        $data->taskDetail()->delete();

        foreach($validatedata['assignment'] as $index=>$assignment)
        {
            TaskDetail::create([
                'task_id'=>$data->id,
                'assignment'=>$assignment,
                'remarks'=>$request->remarks[$index],
                'status'=>$request->status[$index]
            ]);
        }
        return response()->json(['success'=>true]);
    }
        catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function taskDetail($id){
        if(Auth::user()->role_id==1){
        $tasks=Task::with(['taskDetail','createdBy'])->where('id',$id)->get();
    }else{
        $tasks=Task::with(['taskDetail','createdBy'])->where('created_by',Auth::id())->where('id',$id)->get();
    }
        return view('DailyTask.TaskDetail',compact('tasks'));
    }

    public function report($id){
       $users= Task::with(['taskDetail','createdBy'])->where('created_by',$id)->get();
        return view('DailyTask.report',compact('users'));
    }
}
