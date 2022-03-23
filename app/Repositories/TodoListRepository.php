<?php

namespace App\Repositories;

use App\Models\TodoList;

class TodoListRepository implements TodoListRepositoryInterface
{

    public function all()
    {
//        return TodoList::orderBy('name')->with('todoLists')->get()->map(function ($todolist) {
//            return $this->format($todolist);
////                [
////                    'todoListId' => $todolist->id,
////                    'name' => $todolist->name,
////                    'created_by' => $todolist->todoLists->email,
////                    'updated_at' => $todolist->updated_at->diffForHumans(),
////                ];
//        });

        return TodoList::orderBy('name')->with('todoLists')->get()->map->format();
    }


    public function findById($todolistId)
    {
//        return TodoList::where('id', $todolistId)->with('todoLists')->get()->map(function ($todolist) {
//            return $todolist->format();
//            // return $this->format($todolist);
//            //          return
////               [
////                   'todoListId' => $todolist->id,
////                   'name' => $todolist->name,
////                   'created_by' => $todolist->todoLists->email,
////                   'updated_at' => $todolist->updated_at->diffForHumans(),
////               ];
//        });


        return TodoList::where('id', $todolistId)->with('todoLists')->firstOrFail()->format();


    }

//    protected function format($todolist)
//    {
//        return
//            [
//                'todoListId' => $todolist->id,
//                'name' => $todolist->name,
//                'created_by' => $todolist->todoLists->email,
//                'updated_at' => $todolist->updated_at->diffForHumans(),
//            ];
//    }


    public function update($id)
    {
        $todoList = TodoList::where('id', $id)->firstOrFail();
        $todoList->update(request()->only('name'));
    }

    public function delete($id)
    {
        $todoList = TodoList::where('id', $id)->delete();

    }


}
