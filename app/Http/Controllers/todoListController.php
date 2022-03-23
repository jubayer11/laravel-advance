<?php

namespace App\Http\Controllers;

use App\Http\Resources\todoListResource;
use App\Models\TodoList;
use App\Repositories\TodoListRepository;
use App\Repositories\TodoListRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class todoListController extends Controller
{
    /**
     * @var TodoListRepository
     */
    private $todolistRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TodoListRepositoryInterface $todoListRepository)
    {
        $this->todolistRepository = $todoListRepository;
    }

    public function index()
    {
        //
        //$list = TodoList::all();

//        $list = TodoList::where('user_id', '=', auth()->id())->get();
        $list = auth()->user()->todoLists;
        return todoListResource::collection($list);
//        return response(['list'=>['name'=>'something','id'=>1]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'category' => 'required']);

        $list = auth()->user()->todoLists()->create($request->all());
        //
//        $list=TodoList::create(['name'=>$request->name,'category'=>$request->category]);
//        $request['user_id'] = auth()->id();
//        $list = TodoList::create($request->all());
        //return response($list, Response::HTTP_CREATED);
        return new todoListResource($list);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $listId)
    {
        //
        //$list=TodoList::find($listId);
//        $list=TodoList::findOrFail($listId);

        return new todoListResource($listId);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $listId)
    {
        //
        $request->validate(['name' => ['required']]);
        $listId->update($request->all());
        return new todoListResource($listId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $listId)
    {
        //
        $listId->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }


    public function repositoryIndex()
    {

        $todolist = $this->todolistRepository->all();


        return $todolist;
    }

    public function repositoryShow($id)
    {

        $todolist = $this->todolistRepository->findById($id);


        return $todolist;
    }

    public function repositoryUpdate($id)
    {
        $this->todolistRepository->update($id);
        return redirect('/repository/show/' . $id);
    }


    public function repositoryDelete($id)
    {
        $this->todolistRepository->delete($id);
        return redirect('/repository/index');
    }

    //the benefit of this if we have another controller which needs this we can simply call it like this.




}
