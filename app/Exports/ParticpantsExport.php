<?php

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticpantsExport implements FromView
{
    /**
    * @return \Illuminate\Contracts\View
    */
    public function view(): View
    {
        $participants = Participant::all();
        return view('participant.excel', compact('participants'));
    }
}
