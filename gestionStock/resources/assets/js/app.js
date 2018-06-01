require('./bootstrap');
window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('purchase-requests', require('./components/purchaseRequest/PurchaseRequestIndexComponent.vue'));
Vue.component('pagination', require('laravel-vue-pagination'));
const app = new Vue({
    el: '#app',

    data : {

        product : {
            customsCost : 0,
            quantity : 0,
            transportCost : 0,
            prixUnitaire : 0,
            coutDivers : 0
        },
        
        id : '',

        selected : ''
    },
    computed :{
        coutTotal : function(){
            return (this.product.quantity * this.product.prixUnitaire + parseInt(this.product.coutDivers) + parseInt(this.product.customsCost) + parseInt(this.product.transportCost) ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
        },
        prixUnitaireFormat : function(){
            return (this.product.prixUnitaire).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
        }
    },

    methods : {
        onSubmit : function() {
            axios.post('/bon-achat', this.$data)
                .then(response => alert('success'))
                //.catch(error => this.errors.record(error.response.data))
        },

        onChange : function() {
            console.log(this.selected)
            axios.get('/produits/info/' + this.selected)
                .then((response) => {
                    console.log(response)
                    this.product.prixUnitaire = parseInt(response.data)

                })
        },
        confirm : (e) => {
            hi = confirm("Êtes-vous sûr de vouloir enregistrer l'Achat? Plus aucune modification ne pourra être apportée")
            if(!hi){
                e.preventDefault();
            }
        }, 
        saveRequest : function(id, e) {
            hi = confirm("Êtes-vous sûr de vouloir enregistrer l'Achat? Plus aucune modification ne pourra être apportée")
            if(!hi){
                e.preventDefault();
            } else {
                console.log(id)
                axios.get('/save-purchase-request/' + id)
                    .then(response =>
                        window.location.href = "/demande-achat/" + id
                    )
            }
        },
        saveSaleOrder : function(id, e) {
            hi = confirm("Êtes-vous sûr de vouloir enregistrer le bon de vente? Plus aucune modification ne pourra être apportée")
            if(!hi){
                e.preventDefault();
            } else {
                console.log(id)
                axios.get('/save-sale-order/' + id)
                    .then(response =>
                        window.location.href = "/bon-vente/" + id
                    )
            }
        }
    },
    
});

