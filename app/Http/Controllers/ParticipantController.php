<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Details;
use App\Models\Event;
use App\Models\Participant;
use App\Models\Transaction;
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

        $events = Event::all();
        $participants = Participant::latest();
        $schools = Details::all();
        $eventFilter = request()->has('event_filter') ? request()->input('event_filter') : 0;
        $userFilter = request()->has('school_filter') ? request()->input('school_filter') : 0;

        $eventFilter != 0 ? $participants->where('event_id', $eventFilter) : "";
        $userFilter != 0 ? $participants->where('user_id', $userFilter) : "";

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
        $eventId = $request->query('event');
        $event = Event::find($eventId);
        $section = $event->section;
        return view('participant.create', compact('event', 'section'));
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
        $count = $request->max_participants;
        $request->validated();
        $participants = [];
        $amount = 0;
        for ($i = 0; $i < $count; $i++) {
            $amount += 50;
            $participants[] = [
                'name' => $request->name[$i],
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
            ];
        }

        $transaction = Transaction::create([
            'amount' => $amount,
            'number' => 0
        ]);
        $transaction->participants()->createMany($participants);
        return redirect()->route('participant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantRequest  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantRequest $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
