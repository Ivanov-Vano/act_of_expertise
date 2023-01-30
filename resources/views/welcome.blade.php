<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Формирование акта</title>
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Акт экспертизы
            </div>
            <form method="post" action="{{ route('download.docx') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Наименование</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="card-footer text-center">
                        <input type="submit" name="btn btn-success w-25" value="Сформировать">
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
