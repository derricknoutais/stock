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
        <header class="container my-5">
            <h1 class="text-center">GPA Calculator</h1>
        </header>
        <main class="my-3 container ">
            <div class="row justify-content-center my-3">
                <div class="col-xs-4 mx-3">
                    <select name="credit" class="form-control">
                        <option value="" disabled selected>Select Credits</option>
                        <option value="3">3 Credits</option>
                        <option value="4">4 Credits</option>
                    </select>
                </div>
                <div class="col-xs-4 mx-3">
                    <select name="grade" class="form-control">
                        <option value="F">Fail</option>
                        <option value="P">Pass</option>
                        <option value="C">Cunt</option>
                        <option value="D">Distinction</option>
                        <option value="HD">High Distinction</option>
                    </select>
                </div>
                <div class="col-xs-4 mx-3">
                    <a name="" id="" class="btn btn-secondary" href="#" role="button" >Add</a>
                </div>   
            </div>

            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Number of credits</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"></td>
                            <td>@{{test}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>


        </main>
    </div>
    
    <script src="/js/app.js"></script>
</body>
</html>