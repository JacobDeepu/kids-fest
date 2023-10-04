<table>
    <thead>
        <tr>
                <th>
                    {{ __('School') }}
                </th>
                <th>
                    {{ __('Place') }}
                </th>
                <th>
                    {{ __('Email') }}
                </th>
                <th>
                    {{ __('Phone') }}
                </th>
                <th>
                    {{ __('Staff Phone') }}
                </th>
            </tr>
    </thead>
    <tbody>
        @foreach ($schools as $school)
            <tr>
                <td>
                    {{ $school->user->name }}
                </td>
                <td>
                    {{ $school->place }}
                </td>
                <td>
                    {{ $school->user->email }}
                </td>
                <td>
                    {{ $school->phone }}
                </td>
                <td>
                    {{ $school->staff_phone }}
                </td>
            </tr>
            @endforeach
    </tbody>
</table>