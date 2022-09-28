<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Details;

class TransactionControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('transaction list');

        $schools = Details::all();
        $transactions = Transaction::latest();
        // Filter
        $userFilter = request()->has('school_filter') ? request()->input('school_filter') : 0;
        $userFilter != 0 ? $transactions->where('user_id', $userFilter) : "";
        $transactions = $transactions->paginate(5);
        return view('transaction.index', compact('transactions', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $this->authorize('transaction create');
        Transaction::create($request->validated());
        return redirect()->route('participant.create');
    }
}
