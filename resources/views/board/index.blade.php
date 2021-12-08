<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- output board article list -->
    <table>
        <tr>
            <th>
                NO
            </th>
            <th>
                TITLE
            </th>
            <th>
                USER ID
            </th>
        </tr>

        @foreach ($boards as $item)
            <tr>
                <td>
                    {{ $item->id }}
                </td>
                <td>
                    <a href="/board/{{ $item->id }}">{{ $item->title }}</a>
                </td>
                <td>
                    {{ $item->user->name }}
                </td>
            </tr>
        @endforeach
    </table>

    {{ $boards->links() }}

    <!-- write button -->
    <a href={{ route('board.create') }}>
        <button>
            write
        </button>
    </a>
</body>

</html>
