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
    <div class="container" id="app">
        <h1 class="text-center"></h1>
        <div class="row">
            <div class="col-xs-6 my-5 ">
                <div class="form-group">
                  <input type="text" class="form-control" v-model="screen">
                </div>
            </div>
        </div> 
        <div class="row my-1">
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clear">AC</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clear">C</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" >^</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="getTypeOperation('/')">/</button>
            </div>
        </div>
        
        <div class="row my-1">
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(7)">7</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(8)">8</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(9)">9</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="getTypeOperation('*')">*</button>
            </div>
        </div>

        <div class="row my-1">
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(4)">4</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(5)">5</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(6)">6</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="getTypeOperation('-')">-</button>
            </div>
        </div>

        <div class="row my-1">
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(1)">1</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(2)">2</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(3)">3</button>
            </div>
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="getTypeOperation('+')">+</button>
            </div>
        </div>

        <div class="row my-1">
            <div class="col-xs-2 mx-1">
                <button type="button" name="" id="" class="btn btn-info btn-lg btn-block" @click="clickButton(0)">0</button>
            </div>
            <div class="col-xs-2 mx-1">
                <a href="" class="btn btn-info btn-block btn-lg col-xs-4">,</a>
            </div>
            <div class="col-xs-2 mx-2"></div>
            <div class="col-xs-2 ml-4">
                <button type="button" name="" id="equal" class="btn btn-info btn-lg btn-block" @click="performOperation()">=</button>
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>