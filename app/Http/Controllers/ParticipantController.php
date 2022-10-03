<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Details;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('participant list');

        //For participant listing
        $events = Event::all();
        $schools = Details::all();
        $participants = Participant::latest();
        // Filter
        $eventFilter = request()->has('event_filter') ? request()->input('event_filter') : 0;
        $userFilter = request()->has('school_filter') ? request()->input('school_filter') : 0;
        $eventFilter != 0 ? $participants->where('event_id', $eventFilter) : "";
        $userFilter != 0 ? $participants->where('user_id', $userFilter) : "";
        // Search
        if (request()->has('search')) {
            $participants->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        $participants = $participants->paginate(5);
        return view('participant.index', compact('events', 'schools', 'participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('participant create');
        // For create listing
        $events = Event::all();
        $userId = auth()->user()->id;
        $participants = Participant::where('user_id', $userId)->get();
        $eventIds = $participants->pluck('event_id');
        $amount = (count($participants->where('event_id', '!=', 14)) + 1) * 50;
        return view('participant.create', compact('events', 'participants', 'amount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantRequest $request)
    {
        $this->authorize('participant create');
        $userId = auth()->user()->id;
        Participant::create([
            'name' => $request->name,
            'event_id' => $request->event_id,
            'user_id' => $userId,
        ]);
        return redirect()->route('participant.create')->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantRequest $request)
    {
        $this->authorize('participant edit');
        $count = count($request->participant_id);
        $request->validated();
        for ($i = 0; $i < $count; $i++) {
            Participant::where('id', $request->participant_id[$i])
                ->update(['name' => $request->name[$i]]);
        }
        return redirect()->route('participant.create');
    }
}
