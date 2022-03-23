<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];
    public const NOT_STARTED = 'not_started';
    public const STARTED = 'started';
    public const PENDING = 'pending';

    public function todolist()
    {
        return $this->belongsTo(TodoList::class, 'todolistId', 'id');
    }
}
