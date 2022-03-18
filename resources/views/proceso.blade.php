<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Proceso</title>
</head>
<body>
<main class="container">
    <h1>Proceso de formulario</h1>
    <div class="alert bg-light shadow-sm p-4">
        La frase enviada es: <br>
        <span class="lead">
            {{$frase}}
        </span>
        <br>
        <a href="/formulario" class="btn btn-outline-secondary">Volver a formulario</a>
    </div>
</main>
</body>
</html>