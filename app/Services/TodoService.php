<?php

namespace App\Services;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class TodoService
{
    public function getTodoList(int $deleted): Collection
    {
        $user_id = Auth::user()->id;
        return Todo::where('user_id', $user_id)->where('removed', $deleted)->get();
    }

    public function create(array $fields)
    {
        $user_id = Auth::user()->id;
        try {
            $todo = Todo::create([
                'user_id' => $fields['user_id'],
                'title' => $fields['title'],
                'content' => $fields['content']
            ]);
            return $todo;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function softRemoveToggle(int $todo_id)
    {
        $user_id = Auth::user()->id;
        try {
            $todo = Todo::Where('user_id', $user_id)->where('id', $todo_id)->first();
            if (!$todo_id) {
                throw new Exception('todo not found', 404);
            }
            $todo->removed = !$todo->removed;
            $todo->save();
            return $todo;
        } catch (Exception $err) {
            throw new Exception($err->getMessage(), $err->getCode());
        }
    }

    public function doneToggle(int $todo_id)
    {
        $user_id = Auth::user()->id;
        try {
            $todo = Todo::Where('user_id', $user_id)->where('id', $todo_id)->first();
            if (!$todo_id) {
                throw new Exception('todo not found', 404);
            }
            $todo->done = !$todo->done;
            $todo->save();
            return $todo;
        } catch (Exception $err) {
            throw new Exception($err->getMessage(), $err->getCode());
        }
    }

    public function getTodo(int $todo_id)
    {
        $user_id = Auth::user()->id;
        try {
            $todo = Todo::Where('user_id', $user_id)->where('id', $todo_id)->first();
            if (!$todo_id) {
                throw new Exception('todo not found', 404);
            }
            return $todo;
        } catch (Exception $err) {
            throw new Exception($err->getMessage(), $err->getCode());
        }
    }

    public function update(array $fields)
    {
        $user_id = Auth::user()->id;

        try {
            $todo = Todo::Where('user_id', $user_id)->where('id', $fields['id'])->first();
            if (!$todo) {
                throw new Exception('todo not found', 404);
            }
            $todo->title = $fields['title'];
            $todo->content = $fields['content'];
            $todo->save();
            return $todo;
        } catch (Exception $err) {
            throw new Exception($err->getMessage(), $err->getCode());
        }
    }
}
