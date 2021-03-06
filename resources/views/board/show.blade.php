<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1> board article</h1>

    <div class="board">
        <h2> Title : {{ $board->title }}</h2>
        <p> Username : {{ $board->user->name }}</p>
        <p> Email : {{ $board->user->email }}</p>
        <p> Description : {{ $board->description }}</p>
        <p> Created At : {{ $board->created_at }}</p>
        <p> Updated At : {{ $board->updated_at }}</p>
    </div>

    <button>
        <a href="{{ route('board.index') }}">Back </a>
    </button>
    <button>
        <a href="{{ route('board.edit', ['board' => $board->id]) }}">Edit </a>
    </button>
    <button onclick="deleteBoard();">
        delete
    </button>
    <script>
        function deleteBoard() {
            if(confirm('Are you sure?')) {
                fetch('/board/{{ $board->id }}', {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(res => {
                    window.location.href = '/board';
                })
            }
        }
    </script>
</body>
</html>
