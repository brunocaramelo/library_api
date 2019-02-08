<?php

namespace Tests\DatabaseRefreshAndSeed;

trait RefreshDatabase
{
    
    public function refreshDatabase()
    {
        dd('caralgho');
        $this->refreshInMemoryDatabase();
    }

    protected function refreshInMemoryDatabase()
    {
        dd('porra');
        $this->artisan('migrate');
        $this->artisan('db:seed');
        
        $this->app[Kernel::class]->setArtisan(null);
    }

    public function runDatabaseMigrations()
    {
        dd('porra');
        $this->artisan('migrate:fresh');

        $this->app[Kernel::class]->setArtisan(null);

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');

            RefreshDatabaseState::$migrated = false;
        });
    }
}