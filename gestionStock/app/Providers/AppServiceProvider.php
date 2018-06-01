<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo 'XAF ' . number_format($amount, 0, ',', '.'); ?>";
        });

        Blade::directive('state', function ($state) {
            return "<?php 
                if($state == -1){
                    echo 'Annulé';
                } else if($state == 0){
                    echo 'En Cours...';
                } else if($state == 1){
                    echo 'D.A en attente de validation (0/2)';
                } else if($state == 2){
                    echo 'D.A en attente de validation (1/2)';
                } else if($state == 3){
                    echo 'D.A validée';
                } else if($state == 4){
                    echo 'Stock Reçu';
                }
            ?>";
        });
        Blade::directive('print', function($type){
            return "<?php

                if($type == 'HB'){
                    echo 'Huiles de Base';
                } else if($type == 'AD'){ 
                    echo 'Additifs';
                } else if($type == 'PHD') {
                    echo 'PEHD';
                } else if($type == 'VR') {
                    echo 'Vérole';
                } else {
                    echo 'Produits de Base';
                }
            ?>";

        });


        

        
    }   

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
