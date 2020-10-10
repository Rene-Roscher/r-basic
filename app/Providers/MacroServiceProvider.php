<?php


namespace RServices\Providers;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /**
         * For oAuth 2 Providers
         */
        Blueprint::macro('social2', function (array $providers) {
            foreach ($providers as $provider) {
                $this->string("{$provider}_id")->nullable()->unique();
                $this->string("{$provider}_token")->nullable()->unique();
                $this->string("{$provider}_refresh_token")->nullable()->unique();
                $this->string("{$provider}_expires_in")->nullable();
            }
        });
        Blueprint::macro('default', function () {
            $this->uuid('id');
            $this->softDeletes();
        });
        Blueprint::macro('amount', function ($columnName = 'amount') {
            $this->decimal('amount', 10,2)->default(0.00);
        });
    }

}
