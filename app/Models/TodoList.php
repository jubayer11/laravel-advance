<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($todolist) {
            $todolist->tasks->each->delete();
        });

    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'todolistId', 'id',);
    }

    public function todoLists()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


    public function format()
    {
        return
            [
                'todoListId' => $this->id,
                'name' => $this->name,
                'created_by' => $this->todoLists->email,
                'updated_at' => $this->updated_at->diffForHumans(),
            ];
    }
}
