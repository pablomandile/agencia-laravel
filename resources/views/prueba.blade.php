<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Prueba</title>
</head>
<body>
<main class="container">
    <h1>vista de prueba</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, voluptates ullam magni quia fugiat quis recusandae officia nam consequatur deleniti corrupti. Odit eius tenetur tempora sed nisi quos dolores quidem?</p>
    <ul class="list-group">
        @for ($i=1; $i<13; $i++)
            <li class="list-group-item">item de lista {{ $i }}</li>
        @endfor
    </ul>
</main>
</body>
</html>