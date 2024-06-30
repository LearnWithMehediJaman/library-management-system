<?php

namespace Modules\Category;

use Modules\Support\BaseServiceProvider;

class CategoryServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        parent::boot();

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'category');
    }
}