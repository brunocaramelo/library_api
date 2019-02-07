<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\File;

trait RefreshDatabase
{
    /**
     * Refresh the database to a clean version.
     */
    public function refreshDatabase(): void
    {
        $basePath = base_path('tests/data/base.sqlite');

        $copyPath = base_path('tests/data/database.sqlite');

        if (file_exists($basePath) === false) {
            copy($copyPath, $basePath);
        } else {
            copy($basePath, $copyPath);
        }
    }
}