<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html" />

    <title>{{ $title }}</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>
    <h1>Kids Fest 2022</h1>
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
</body>

</html>