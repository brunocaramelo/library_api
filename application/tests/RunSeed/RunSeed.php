<?php

namespace Tests\RunSeed;

use Illuminate\Support\Facades\Artisan as Artisan;

trait RunSeed
{
    public function runSeed()
    {
        Artisan::call('db:seed', ['--class' => 'Seeds\ImporFakeJsonSeeder' ]);
    }
}