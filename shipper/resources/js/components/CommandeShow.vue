
<script>
export default {
    props: ['commande_prop', 'products_prop' ],
    data(){
        return {
            selected_product: false,
            selected_template: false,
            commande: null,
            isLoading : {
                stock: false,
                reorder_point: false,
            },
            reorderPoint : null,
            products : null,
            editing: false,
        }
    },
    methods:{
        addProduct(){
            axios.post('/product-commande', {commande_id : this.commande.id, product_id : this.selected_product.id } ).then(response => {
                if(response.data === 'OK'){
                    this.commande.products.push(this.selected_product)
                }
            }).catch(error => {
                alert('Un problème est survenu lors du chargement des stocks. Veuillez relancer la MàJ des Stocks')
            });
        },
        addTemplate(){
            axios.post('/template-commande', {commande_id : this.commande.id, template_id : this.selected_template.id } ).then(response => {
                if(response.data === 'OK'){
                    this.commande.templates.push(this.selected_template)
                    this.$forceUpdate()
                }
            }).catch(error => {
                console.log(error);
            });
        },
        majStock(){
            
            if(this.numberOfProducts > 0){
                // Turn Stock isLoading Flag On 
                this.isLoading.stock = true;
                // Grab stock from vend
                axios.get('/api/stock').then( response => {
                    if (this.commande.products) {
                        // If I get response Iterate over Products
                        this.commande.products.forEach( product => {
                            // Foreach Product Iterate over Stock
                            response.data.forEach( stock => {
                                // If Product Matches Stock ... 
                                if(product.product_id === stock.product_id)
                                {
                                    // Add Stock to Product
                                    product.stock = stock.inventory_level
                                }
                            });
                        });  
                    }
                    
                    if(this.commande.templates){
                        // Iterate over Templates
                        this.commande.templates.forEach( template => {
                            // Foreach Template Iterate over products
                            template.products.forEach( product => {
                                // Foreach Product Iterate over Stock
                                response.data.forEach( stock => {
                                    // If Product Matches Stock ... 
                                    if(product.product_id === stock.product_id)
                                    {
                                        // Add Stock to Product
                                        product.stock = stock.inventory_level
                                    }
                                });
                            }); 
                        });
                    }

                    if(this.commande.reorderpoint[0]){
                        // For Reorder Point Iterate over products
                        this.commande.reorderpoint[0].products.forEach( product => {
                            // Foreach Product Iterate over Stock
                            response.data.forEach( stock => {
                                // If Product Matches Stock ... 
                                if(product.product_id === stock.product_id)
                                {
                                    // Add Stock to Product
                                    product.stock = stock.inventory_level
                                }
                            });
                        });
                    }

                    this.$forceUpdate();
                    this.isLoading.stock = false;
                }).catch(error => {
                    console.log(error);
                });
            } else {
                alert('Aucun Produit dans la commande. Ajoutez des produits')
            }
            
        },
        addReorderpoint(){
            axios.post('/reorderpoint-commande', {commande_id : this.commande.id}).then(response => {
                console.log(response.data);
            }).catch(error => {
                console.log(error);
            });
        },
        // Toggle Editing 
        toggleEdit(){
            this.editing = ! this.editing 
        },
        // Enregistre les quantités souhaitées
        save(){
            // this.commande.templates.forEach( template => {
            //     template.products.map( template_product => {
            //         var found = this.commande.products.find( product => {
            //             if(product.id === template_product.id){
            //                 found.pivot.quantity = template_product.quantity
            //             }
            //         })
                    
            //     })
            // })
            

            axios.post('/commande-quantité', this.commande ).then(response => {
                console.log(response.data);
            }).catch(error => {
                console.log(error);
            });
        },
        mapArrays(){
            if(this.commande){
                this.commande.templates[0].products.map( template_product => {
                    var found = this.commande.products.find( product => {
                        return product.id === template_product.id
                    })
                    template_product.quantity = found.pivot.quantity
                })
            }
        }


    },
    computed : {
        numberOfProducts(){
            var total = 0;
            if(this.commande){

                if(this.commande.templates){
                    this.commande.templates.forEach( template => {
                        if(template.products){
                            total += template.products.length;
                        } else {
                            total += 0;
                        }
                    });
                }

                if(this.commande.reorderpoint){
                    this.commande.reorderpoint.forEach( reorderpoint => {
                        total += reorderpoint.products.length;
                    });
                }

                if(this.commande.products){
                    total += this.commande.products.length;
                }

            }
            return total;
        }
    },
    mounted(){
        // if(this.numberOfProducts)
            // this.majStock()
        // this.addReorderpoint()
    },
    created(){
        if (this.commande_prop) {
            this.commande = this.commande_prop
        }
        if(this.products_prop){
            this.products = this.products_prop
        }
        this.mapArrays()
    }
}
</script>