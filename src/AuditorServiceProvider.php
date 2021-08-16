<?php

namespace Quarks\Laravel\Auditors;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class AuditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('auditors', function () {
            /** @var Blueprint $this */
            $this->nullableMorphs('created_by');
            $this->nullableMorphs('updated_by');
            $this->nullableMorphs('deleted_by');
            return $this;
        });
        Blueprint::macro('dropAuditors', function () {
            /** @var Blueprint $this */
            $this->dropMorphs('created_by');
            $this->dropMorphs('updated_by');
            $this->dropMorphs('deleted_by');
            return $this;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
