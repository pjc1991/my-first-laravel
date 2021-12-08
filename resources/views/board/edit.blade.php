<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>edit board article</h1>
    <form action="{{ route('board.update', $board) }}" method="POST">
        @method('PUT')
        @csrf
        <input type="text" name="title" placeholder="title" value="{{ $board->title }}">
        <textarea name="description" id="" cols="30" rows="10"
            placeholder="content">{{ $board->description }}</textarea>
    </form>
        <button>Edit!</button>
</body>

</html>
