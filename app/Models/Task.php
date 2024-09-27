<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=['title','starting_date','due_date','note','status','created_by','updated_by'];
    public function createdBy(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function taskDetail(){
        return $this->hasMany(TaskDetail::class);
    }
}
