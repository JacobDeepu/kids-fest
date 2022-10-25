<?php

namespace App\Http\Controllers;

use App\Exports\ParticpantsExport;
use App\Http\Requests\StoreParticipantRequest;
use App\Http\Requests\UpdateParticipantRequest;
use App\Models\Details;
use App\Models\Event;
use App\Models\Participant;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

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
        $user = auth()->user();
        if ($user->can('filter by school')) {
            $participants = Participant::latest();
        } else {
            $participants = $user->participants()->latest();
        }
        // Filter
        $eventFilter = request()->has('event_filter') ? request()->input('event_filter') : 0;
        $userFilter = request()->has('school_filter') ? request()->input('school_filter') : 0;
        $eventFilter != 0 ? $participants->where('event_id', $eventFilter) : "";
        $userFilter != 0 ? $participants->where('user_id', $userFilter) : "";
        // Search
        if (request()->has('search')) {
            $participants->where('name', 'Like', '%' . request()->input('search') . '%');
        }
        $participants = $participants->paginate(20);
        return view('participant.index', compact('events', 'schools', 'participants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('participant create');
        $events = Event::all();
        $userId = auth()->user()->id;
        $participants = Participant::where('user_id', $userId)->get();
        $eventIds = $participants->pluck('event_id');
        $amount = count($participants) * 50;
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
        $request->validated();
        $userId = auth()->user()->id;
        $event = $request->event_id;
        Participant::create([
            'name' => strtoupper($request->name),
            'event_id' => $event,
            'user_id' => $userId,
        ]);
        session()->put('event', $event);
        return redirect(url()->previous() . '#accordion-heading-' . $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        $this->authorize('participant edit');
        return view('participant.edit', compact('participant'));
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
        $this->authorize('participant edit');
        $request->validated();
        $participant->update(['name' => strtoupper($request->name)]);
        return redirect()->route('participant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        $this->authorize('participant delete');
        $participant->delete();
        return redirect()->route('participant.index');
    }

    /**
     * Export as pdf.
     */
    public function exportPDF()
    {
        $user = auth()->user();
        $name = auth()->user()->name;
        if ($user->can('filter by school')) {
            $participants = Participant::get();
        } else {
            $participants = $user->participants()->get();
        }
        $data = [
            'title' => 'Participant List',
            'name' => $name,
            'date' => date('m/d/Y'),
            'participants' => $participants
        ];
        $pdf = PDF::loadView('participant.export', $data);
        return $pdf->download('participants.pdf');
    }

    /**
     * Export as excel.
     */
    public function exportExcel()
    {
        return Excel::download(new ParticpantsExport, 'participants.xlsx');
    }
}
