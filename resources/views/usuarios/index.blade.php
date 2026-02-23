<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de empleados</h1>
    <ul>
        @foreach ($usuarios as $u)
        <li> {{ $u->name }} - Departamento: {{ $u->department->name }}</li>
        @endforeach
    </ul>
</body>

</html>