<?php

namespace App\Http\Controllers;

use App\Messages\GeneralMessages;
use App\Models\FunctionModel;
use App\Models\MemoLine;
use App\Models\UserFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemoLinesController extends Controller
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
        if (UserFunction::where('user_id', Auth::user()->id)->count() === 0) {
            return redirect('/')->with('error', GeneralMessages::USER_NOT_AUTHORIZETION);
        }

        return view('memo_lines/index')
            ->with('function', FunctionModel::where('route', 'memo_lines')
                ->first()
            )
            ->with('memo_line', MemoLine::where('user_id', Auth::user()->id)
                ->orderByDesc('created_at')
                ->get()
            );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('memo_lines/create')
            ->with('function', FunctionModel::where('route', 'memo_lines')
                ->first());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'memo' => 'required|max:100',
        ]);

        $model = new MemoLine();
        $result = $model->fill($validated)->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/memo_lines')->with('success', GeneralMessages::MEMO_ADDED);
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
        return view('memo_lines/edit')
            ->with('function', FunctionModel::where('route', 'memo_lines')
                ->first()
            )
            ->with('memo_line', MemoLine::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'memo' => 'required|max:100',
        ]);

        $model = MemoLine::find($id);
        $model->memo = $validated['memo'];

        $result = $model->save();
        if (false === $result) {
            // 例外
        }

        return redirect('/memo_lines')->with('success', GeneralMessages::MEMO_SAVED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MemoLine::destroy($id);

        return redirect('/memo_lines')->with('success', GeneralMessages::MEMO_DELETED);
    }
}
