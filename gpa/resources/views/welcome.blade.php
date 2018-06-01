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
        <main class="my-3 container">
            <div class="row justify-content-center my-3">
                <div class="col-xs-4 mx-3">
                    <select name="grade" class="form-control" v-model="grade">
                        <option value=0 disabled selected>Select Credits</option>
                        <option value="F">Fail</option>
                        <option value="P">Pass</option>
                        <option value="C">Cunt</option>
                        <option value="D">Distinction</option>
                        <option value="HD">High Distinction</option>
                    </select>
                </div>
                <div class="col-xs-4 mx-3">
                    <select name="credit" class="form-control" v-model="credit">
                        <option value=0 disabled selected>Select Credits</option>
                        <option value=3>3 Credits</option>
                        <option value=4>4 Credits</option>
                    </select>
                </div>
                <div class="col-xs-4 mx-3">
                    <a name="" id="" class="btn btn-secondary" href="#" role="button" @click="addCourse">Add</a>
                </div>   
            </div>
            <div class="row justify-content-center my-3" v-if="empty">
                <p class="text-danger">Please select both options</p>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Grade</th>
                            <th>Point Earned</th>
                            <th>Number of credits</th>
                            <th>Total Points Earned</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="course in courses">
                            <td>@{{course.grade}}</td>
                            <td>@{{course.value}}</td>
                            <td scope="row">@{{course.credit}}</td>
                            <td>@{{course.total}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td><strong>@{{totalCredit}}</strong></td>
                            <td><strong>@{{grandTotal}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3 class="text-center">Grade Point Average </h3>
            <h3 class="text-center">@{{gpa}}</h3>
        </main>
    </div>
    
    <script src="/js/app.js"></script>
</body>
</html>