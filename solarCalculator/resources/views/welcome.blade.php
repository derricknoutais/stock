<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Calculatrice d'Energie Solaire  </h1>
                </div>         
            </div>
            <div class="row mt-4 b-1 offset-md-4">
                <h3>Voulez vous démarrer </h3>
                <input type="text" v-model="test">
            </div>
            <div class="row mt-4 offset-md-5">
                <a href="#" class="btn btn-primary col-md-2 m-1">Yes</a>
                <a href="#" class="btn btn-primary col-md-2 m-1">No</a>
            </div>
        </div>

    </div>
    <script src="/js/app.js"></script>
</body>
</html>