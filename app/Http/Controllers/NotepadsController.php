<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\FunctionModel;
use App\Models\Notepad;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotepadsController extends Controller
{
    public function __construct(Request $request)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 権限確認
        if (UserFunction::where('user_id', Auth::user()->id)->count() === 0) {
            return redirect('/')->with('error', GeneralMessages::USER_NOT_AUTHORIZETION);
        }

        return view('notepads/index')
            ->with('function', FunctionModel::where('route', 'notepads')
                ->first()
            )
            ->with('notepad', Notepad::where('user_id', Auth::user()->id)
                ->orderByDesc('created_at')
                ->get()
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notepads/create')
            ->with('function', FunctionModel::where('route', 'notepads')
                ->first());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'memo' => 'required',
        ]);

        $model = new Notepad();
        $result = $model->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/notepads')->with('success', GeneralMessages::MEMO_ADDED);
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
        return view('notepads/edit')
            ->with('function', FunctionModel::where('route', 'notepads')
                ->first()
            )
            ->with('notepad', Notepad::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'memo' => 'required',
        ]);

        $model = Notepad::find($id);
        $model->memo = $validated['memo'];

        $result = $model->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/notepads')->with('success', GeneralMessages::MEMO_SAVED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Notepad::destroy($id);

        return redirect('/notepads')->with('success', GeneralMessages::MEMO_DELETED);
    }
}
