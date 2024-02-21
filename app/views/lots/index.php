<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container text-center mt-4">
    <form action="" class="form">
        <div class="row justify-content-md-center">
            <div class="col-3">
                <div class="mb-3">
                    <label for="tradeNumber" class="form-label">Номер торгов</label>
                    <input type="text" class="form-control" name="tradeNumber" id="tradeNumber"
                           placeholder="пример: 31710-ОТПП" value="<?= $_GET['tradeNumber'] ?? '' ?>"" required>
                </div>
                <div id="alert" style="display: none">
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <div>Неверно заполнено поле</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="lotNumber" class="form-label">Номер лота</label>
                    <input type="number" class="form-control" id="lotNumber" value="<?= $_GET['lotNumber'] ?? '' ?>"
                           name="lotNumber" max="9999"
                           placeholder="1-9999" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" id="submitBtn" value="Найти">
                </div>
            </div>
        </div>
    </form>
    <div class="row justify-content-md-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">URL</th>
                <th scope="col">Описание</th>
                <th scope="col">Начальная цена</th>
                <th scope="col">Email контактного лица</th>
                <th scope="col">Номер контактного лица</th>
                <th scope="col">ИНН должника</th>
                <th scope="col">Номер дела</th>
                <th scope="col">Дата проведения</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $d): ?>
                <tr>
                    <th scope="row"><a style="text-decoration: none" href="<?= $d->url ?>" target="_blank">Ссылка</a></th>
                    <td><?= substr($d->content, 0, 10) ?>...</td>
                    <td><?= $d->initial_price ?></td>
                    <td><?= $d->email ?></td>
                    <td><?= $d->phone ?></td>
                    <td><?= $d->debtor_inn ?></td>
                    <td><?= $d->case_number ?></td>
                    <td><?= $d->start_date ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?= URL_ROOT ?>/js/script.js"></script>
</body>
</html>