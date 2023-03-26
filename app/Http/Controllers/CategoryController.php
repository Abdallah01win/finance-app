<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $data = Category::where('userId', '=', $userId)->get();
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        for ($i = 0; $i < count($data); $i++) {
            $row = $data[$i];
            $row['total'] = Transaction::where('userId', '=', $userId)
                ->where('category_id', '=', $row['id'])
                ->whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
                ->sum('ammount');
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return Category::where('userId', '=', Auth::id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
        ]);

        $contact = new Category([
            'userId' => Auth::id(),
            'title' => $request->get('title'),
            'limit' => $request->get('limit'),
            'type' => $request->get('type'),
            'deadline' => $request->get('deadline'),
        ]);
        $contact->save();
        return redirect('/categories')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $timeSpan = isset($request->timeSpan) ? $request->timeSpan : 'month';

        $categories = Category::where('id', $request->id)
            ->with(['transactions' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->get();

        $groupedCategories = $categories->map(function ($category) use ($timeSpan) {
            $transactions = $category->transactions->groupBy(function ($transaction) use ($timeSpan) {
                if ($timeSpan == 'month') {
                    return $transaction->created_at->format('Y-m');
                } elseif ($timeSpan == 'week') {
                    return $transaction->created_at->format('Y-W');
                }
            });

            return [
                'category' => $category,
                'transactions' => $transactions,
            ];
        });
        return Inertia::render('Category', [
            'groupedCategories' => $groupedCategories
        ]);
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
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        DB::table('categories')->where('userId', Auth::id())->Where('id', $id)->delete();
        return redirect('/categories')->with('success', 'Contact Deleted!');
    }
}
