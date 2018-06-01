
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
    data: {
        credit : 0,
        grade : '',
        courses : [  
        ],
        empty: false
    },
    computed : {
        grandTotal : function() {
            var grandTotal = 0;
            this.courses.forEach(course => {
                grandTotal += course.total
            });
            return grandTotal
        },
        totalCredit : function(){
            var total = 0;
            this.courses.forEach(course => {
                total += parseInt(course.credit)
                
            });
            return total;
        },
        gpa : function(){
            if(this.credit != 0 )
                return this.grandTotal/this.totalCredit
        }
    },
    methods : {
        getValueFromGrade : function(grade) {
            if (grade === 'HD')
                return 4
            if (grade === 'D')
                return 3
            if (grade === 'C')
                return 2
            if (grade === 'P')
                return 1
            if (grade === 'F')
                return 0
        },
        addCourse : function() {
            var course = {}
            course.credit = this.credit
            course.grade = this.grade
            course.value = this.getValueFromGrade(this.grade)
            course.total = course.value * course.credit
            if(this.credit !== 0 && this.grade !== ''){
                this.courses.push(course)
                this.empty = false
            } else {
                this.empty = true
            }
        }
    }
});