<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\Details;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionsExport implements FromView
{
    /**
     * @return \Illuminate\Contracts\View
     */
    public function view(): View
    {
        $schools = Details::all();
        return view('transaction.excel', compact('schools'));
    }
}
