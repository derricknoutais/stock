
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data : {
        screen : '',
        derrick : 0,
        operand1 : 0,
        operand2 : 0,
        total : 0,
        typeOperation: '',
        operationDone: ''

    },
    methods :{
        clickButton : function(value){
            if(this.screen === '0')
                this.screen = ''
            if(this.total === '~'){
                this.clear()
                this.screen += value
                this.total = '`'
            } else {
                this.screen += value
            }
        },
        clear : function(){
            this.screen = ''
        },
        getOperand1 : function(){
            this.operand1 = parseInt(this.screen)
        },
        getOperand2 : function(){
            this.operand2 = parseInt(this.screen)
        },

        getTypeOperation : function(value){

            this.getOperand1()
            this.typeOperation = value
            this.clear()
        },

        performOperation : function(){
            this.getOperand2()
            
            if(this.typeOperation === '+'){
                this.total = this.operand1 + this.operand2
                this.typeOperation = ''
            } else if(this.typeOperation === '-'){
                this.total = this.operand1 - this.operand2
                this.typeOperation = ''
            } else if(this.typeOperation === '*'){
                this.total = this.operand1 * this.operand2
                this.typeOperation = ''
            } else if(this.typeOperation === '/'){
                this.total = this.operand1 / this.operand2
                this.typeOperation = ''
            }
            this.screen = this.total
            this.total = '~'
            console.log(this.operand1)
            console.log(this.operand2)
            console.log(this.typeOperation)
        }

    }
    
});
