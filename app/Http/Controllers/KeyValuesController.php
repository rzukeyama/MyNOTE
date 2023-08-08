<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\FunctionModel;
use App\Models\KeyValue;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeyValuesController extends Controller
{
    public function __construct(Request $request)
    {

    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (UserFunction::where('user_id', Auth::user()->id)->count() === 0) {
            return redirect('/')->with('error', GeneralMessages::USER_NOT_AUTHORIZETION);
        }

        return view('key_values.index')
            ->with('function', FunctionModel::where('route', 'key_values')
                ->first()
            )
            ->with('key_value', KeyValue::where('user_id', Auth::user()->id)
                ->orderByDesc('created_at')
                ->get()
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('key_values.create')
            ->with('function', FunctionModel::where('route', 'key_values')
                ->first());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'max:100',
            'key' => 'required|max:100',
            'value' => 'required|max:100',
        ]);

        $model = new KeyValue();
        $result = $model->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/key_values')->with('success', GeneralMessages::MEMO_ADDED);
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
        return view('key_values.edit')
            ->with('function', FunctionModel::where('route', 'key_values')
                ->first()
            )
            ->with('key_value', KeyValue::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'max:100',
            'key' => 'required|max:100',
            'value' => 'required|max:100',
        ]);

        $model = KeyValue::find($id);
        $model->name = $validated['name'];
        $model->key = $validated['key'];
        $model->value = $validated['value'];

        $result = $model->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/key_values')->with('success', GeneralMessages::MEMO_SAVED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KeyValue::destroy($id);

        return redirect('/key_values')->with('success', GeneralMessages::MEMO_DELETED);
    }
}
