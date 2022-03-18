<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <main class="container">
        <h1>Formulario de envío</h1>
        <div class="alert bg-light shadow-sm p-4">
            <form action="/proceso" method="post">
                @csrf
                Frase: <br>
                <input type="text" name="frase" id="" class="form-control">
                <br>
                <button class="btn btn-dark">Enviar frase</button>
            </form>
        </div>
    </main>
</body>
</html>