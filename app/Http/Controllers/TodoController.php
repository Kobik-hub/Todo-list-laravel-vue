<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    private TodoService $todo_service;

    function __construct(TodoService $todoService)
    {
        $this->todo_service = $todoService;
    }

    public function index(Request $request)
    {
        $fields = $request->validate([
            'deleted' => 'required|boolean',
        ]);
        return $this->todo_service->getTodoList($fields['deleted']);
    }

    public function create(Request $request)
    {
        $fields = $request->validate([
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        try{
            $todo = $this->todo_service->create($fields);
            return $todo;
        }catch(Exception $ex){
            return $ex->getMessage();
        }
    }

    public function softRemoveToggle(Request $request)
    {
        $fields = $request->validate([
            'todo_id' => 'required|integer',
        ]);
        try{
            $todo = $this->todo_service->softRemoveToggle($fields['todo_id']);
            return response($todo,200);
        }catch(Exception $ex){
            return response($ex->getMessage(),$ex->getCode());
        }
    }

    public function doneToggle(Request $request)
    {
        $fields = $request->validate([
            'todo_id' => 'required|integer',
        ]);
        try{
            $todo = $this->todo_service->doneToggle($fields['todo_id']);
            return response($todo,200);
        }catch(Exception $ex){
            return response($ex->getMessage(),$ex->getCode());
        }
    }

    public function update(Request $request)
    {
        $fields = $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
        try{
            $todo = $this->todo_service->update($fields);
            return response($todo,200);
        }catch(Exception $ex){
            return response($ex->getMessage(),$ex->getCode());
        }
    }

    public function getTodo(Request $request)
    {
        if(empty($request->input('id'))){
            response('Todo id is required', 400);
        }
        try{
            $todo = $this->todo_service->getTodo((integer) $request->id);
            return response($todo,200);
        }catch(Exception $ex){
            return response($ex->getMessage(),$ex->getCode());
        }
    }

}
