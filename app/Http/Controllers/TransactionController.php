<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //route should be a post one and send fillters through it then build the query with the set ones 
        return Transaction::where('userId', '=', Auth::id())->orderBy('created_at', 'desc')->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $request->validate([
            'title' => 'required',
            'ammount' => 'required',
            'type' => 'required',
            'category' => 'required'
        ]);

        $contact = new Transaction([
            'userId' => $userId,
            'title' => $request->get('title'),
            'date' => $request->get('date'),
            'description' => $request->get('description'),
            'ammount' => $request->get('ammount'),
            'type' => $request->get('type'),
            'category' => $request->get('category')
        ]);
        $calcBalance = intval($request->get('ammount')) ;
        if ($request->get('type') === 'Income') {
            User::where('id', '=', $userId)->limit(1)->increment('balance', $calcBalance);
        }else{
            User::where('id', '=', $userId)->limit(1)->decrement('balance', $calcBalance);
        }   
        $contact->save();
        return redirect('/transactions')->with('success', 'Contact saved!');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
