<table>
    <thead>
        <tr>
            <th><strong>Name</strong>
            <th><strong>Section</strong></th>
            <th><strong>Event</strong></th>
            <th><strong>School</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($participants as $participant)
        <tr>
            <td>{{ $participant->name }}</td>
            <td>{{ $participant->event->section->name }}
            <td>{{ $participant->event->name }}</td>
            <td>{{ $participant->user->name }}
        </tr>
        @endforeach
    </tbody>
</table>