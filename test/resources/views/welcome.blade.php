<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            @{{message}}
            <b-alert show>Default Alert</b-alert>
            <div class="col-md-4">
<b-form-file v-model="file" :state="Boolean(file)" placeholder="Choose a file..."></b-form-file>

            </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
