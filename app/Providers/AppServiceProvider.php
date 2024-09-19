<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder as QueryBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        date_default_timezone_set('Asia/Jakarta');
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        QueryBuilder::macro('leftJoinWhen', function ($condition, $table, $first, $operator = null, $second = null, $type = 'left', $where = false) {
            return $this->when($condition, function ($query) use ($table, $first, $operator, $second, $type, $where) {
                return $query->leftJoin($table, $first, $operator, $second, $type, $where);
            });
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production' || env('APP_ENV') === 'dev_https') {
            URL::forceScheme('https');
        }
    }
}
