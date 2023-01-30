<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Просмотр акта</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                АКТ ЭКСПЕРТИЗЫ № {{ $act->number }} <br>
                для оформления сертификата происхождения товара
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @php($myFio = $act->expert->surname.' '.mb_substr($act->expert->name, 0, 1).'. '.mb_substr($act->expert->patronymic, 0, 1).'.')
                    <li class="list-group-item"><b>1. Эксперт:</b> {{ $myFio }}</li>
                    @php($myDateTime = DateTime::createFromFormat('Y-m-d', $act->date))
                    <li class="list-group-item"><b>2. Дата составления:</b> {{ $myDateTime->format('d.m.Y') }} г.</li>
                </ul>
                <p class="card-text"></p>
                <a href="{{ route('word.export', $act->id ) }}" class="btn btn-primary">Сформировать акт</a>
            </div>
        </div>
    </div>

</body>
</html>
