<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pagination
        $size = request()->get('size') ?? 10;
        $boards = Board::paginate($size);

        return view('board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        // check if user is logged in
        if (!$user) {
            return redirect('/login');
        }

        return view('board.create');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $user = auth()->user();

        // check if user is logged in
        if (!$user) {
            return redirect('/login');
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Board::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('board.index')->with('success', 'Board created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return view('board.show', ['board' => Board::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $user = auth()->user();

        // check if user is logged in
        if (!$user) {
            return redirect('/login');
        }

        // check if user is the owner of the board

        $board = Board::findOrFail($id);

        if ($user->id !== $board->user_id) {
            return redirect()->route('board.index')->with('error', 'You are not authorized to edit this board');
        }
        return view('board.edit', ['board' => $board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $board = Board::findOrFail($id);

        // check if user is the owner of the board

        $user = auth()->user();

        if ($user->id !== $board->user_id) {
            return redirect()->route('board.index')->with('error', 'You are not authorized to edit this board');
        }

        $board->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('board.index')->with('success', 'Board updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        $board = Board::findOrFail($id);

        if ($user->id !== $board->user_id) {
            return redirect()->route('board.index')->with('error', 'You are not authorized to delete this board');
        }

        $board->delete();
    }
}
