<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\FunctionModel;
use App\Models\Todolist;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoListsController extends Controller
{
    public function __construct(Request $request)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * 残作業
     * ・一覧
     * ・データがない場合の表示
     */
    public function index()
    {
        if (UserFunction::where('user_id', Auth::user()->id)
                ->where('function_id', 4)
                ->count() === 0) {
            return redirect('/')->with('error', GeneralMessages::USER_NOT_AUTHORIZETION);
        }

        return view('todo_lists/index')
            ->with('function', FunctionModel::where('route', 'todo_lists')
                ->first()
            )
            ->with('todo_list', TodoList::where('user_id', Auth::user()->id)
                ->orderByDesc('created_at')
                ->get()
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo_lists/create')
            ->with('function', FunctionModel::where('route', 'todo_lists')
                ->first());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'todo' => 'required|max:100',
        ]);

        $model = new TodoList();
        $result = $model->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/todo_lists')->with('success', GeneralMessages::MEMO_ADDED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('todo_lists/edit')
            ->with('function', FunctionModel::where('route', 'todo_lists')
                ->first()
            )
            ->with('todo_list', TodoList::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'todo' => 'required|max:100',
            'done' => 'required',
        ]);

        $model = TodoList::find($id);

        $result = $model->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/todo_lists')->with('success', GeneralMessages::MEMO_SAVED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TodoList::destroy($id);

        return redirect('/todo_lists')->with('success', GeneralMessages::MEMO_DELETED);
    }
}
