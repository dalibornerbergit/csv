<!DOCTYPE html>
<html>

<head>
    <title>CSV</title>
</head>

<body>
    <h1>CSV</h1>

    <form method="POST" action="{{ route('excel') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Import</button>
    </form>
</body>

</html>
