<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
        return Transaction::join('categories', 'categories.id', '=', 'transactions.category_id')
            ->select('transactions.*', 'categories.title as category_name')
            ->where('transactions.userId', '=', Auth::id())
            ->limit(10)
            ->orderBy('transactions.created_at', 'desc')
            ->get();
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
       // dd($request->all());
        $userId = Auth::id();
        $request->validate([
            'title' => 'required',
            'ammount' => 'required',
            'type' => 'required',
            'category' => 'required'
        ]);

        $contact = new Transaction([
            'userId' => $userId,
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'description' => $request->input('description'),
            'ammount' => $request->input('ammount'),
            'type' => $request->input('type'),
            'category_id' => strval($request->input('category'))
        ]);
        $calcBalance = intval($request->get('ammount'));
        if ($request->get('type') === 'Income') {
            User::where('id', $userId)->limit(1)->increment('balance', $calcBalance);
        } elseif ($request->get('type') !== 'Savings') {
            User::where('id', $userId)->limit(1)->decrement('balance', $calcBalance);
        }
        $contact->save();
        return redirect('/transactions')->with('success', 'Transaction saved!');
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

    public function lineChart()
    {
        $transactions = DB::table('transactions')
            ->select(DB::raw('DATE(date) as date'), 'type', DB::raw('SUM(ammount) as total_amount'))
            ->groupBy('date', 'type')
            ->get();

        $transaction_totals = [];

        foreach ($transactions as $transaction) {
            $date = $transaction->date;
            $type = $transaction->type;
            $amount = $transaction->total_amount;

            if (!isset($transaction_totals[$date])) {
                $transaction_totals[$date] = [];
            }

            $transaction_totals[$date][$type] = $amount;
        }
        return $transaction_totals;
    }
}
