<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Список актов</title>
</head>
<body>
<div class="container">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="/admin">
            <img width="30" height="30" class="bi bi-person-circle d-inline-block align-top" alt="">
            Редактирование
        </a>
    </nav>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">№</th>
            <th scope="col">Номер акта</th>
            <th scope="col">Дата составления</th>
            <th scope="col">Эксперт</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($acts as $act)
        <tr>
            <th scope="row">{{ $act->id }}</th>
            <td>{{ $act->number }}</td>
            @php($myDateTime = DateTime::createFromFormat('Y-m-d', $act->date))
            <td>{{ $myDateTime->format('d.m.Y') }}</td>
            @php($myFio = $act->expert->surname.' '.mb_substr($act->expert->name, 0, 1).'. '.mb_substr($act->expert->patronymic, 0, 1).'.')
            <td>{{ $myFio }}</td>
            <td><a href="{{ route('show', $act->id ) }}">Просмотр</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg>
</html>
