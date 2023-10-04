<?php

namespace App\Exports;

use App\Models\Participant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParticipantsExport implements FromView
{
    protected $eventFilter;
    protected $userFilter;

    public function __construct($eventFilter, $userFilter)
    {
        $this->eventFilter = $eventFilter;
        $this->userFilter = $userFilter;
    }

    /**
     * @return \Illuminate\Contracts\View
     */
    public function view(): View
    {
        $participants = Participant::get();
        if ($this->eventFilter != 0) {
            $participants = $participants->where('event_id', $this->eventFilter);
        }
        if ($this->userFilter != 0) {
            $participants = $participants->where('user_id', $this->userFilter);
        }
        return view('participant.excel', compact('participants'));
    }
}
