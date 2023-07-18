<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\FunctionModel;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserFunctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user_functions.index')
            ->with('userFunctions', UserFunction::where('user_id', Auth::user()->id)
                ->orderBy('id')
                ->get())
            ->with('allFunctions', FunctionModel::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_functions.create')
            ->with('userFunctions', UserFunction::where('user_id', Auth::user()->id)
                ->orderBy('id')
                ->get())
            ->with('functions', FunctionModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'function_id' => 'required',
            'user_id' => 'required'
        ]);

        $userFunctions = new UserFunction();
        $result = $userFunctions->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect()->route('user_functions')->with('success', GeneralMessages::USERFUNCTIONS_ADDED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
