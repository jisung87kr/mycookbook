<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('ck') }}" method="post">
        @csrf
        <input type="text" value="1" name="material[2]">
        <input type="text" value="2" name="material[1]">
        <input type="submit" value="ss">
    </form>
</body>
</html>