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
    <h2>{{ $name }}</h2>
    <table>
        <thead>
            <tr>
                <th>
                    {{ __('Name') }}
                </th>
                <th>
                    {{ __('Section') }}
                </th>
                <th>
                    {{ __('Event') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
            <tr>
                <td>
                    {{ $participant->name }}
                </td>
                <td>
                    {{ $participant->event->section->name }}
                </td>
                <td>
                    {{ $participant->event->name }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>