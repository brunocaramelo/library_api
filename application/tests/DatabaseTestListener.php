<?php

namespace Tests;

use Illuminate\Support\Facades\File;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class DatabaseTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    /**
     * Set up the database for testing.
     *
     * @param TestSuite $suite
     */
    public function startTestSuite(TestSuite $suite): void
    {
        if ($suite->getName() !== 'Feature') {
            return;
        }

        chdir(__DIR__ . '/..');

        shell_exec('php artisan migrate:refresh --seed');
    }

    /**
     * Clean up the database files.
     *
     * @param TestSuite $suite
     */
    public function endTestSuite(TestSuite $suite): void
    {
        if ($suite->getName() !== 'Feature') {
            return;
        }

        $basePath = __DIR__ . '/data/base.sqlite';

        if (file_exists($basePath)) {
            unlink($basePath);
        }

        $copyPath = __DIR__ . '/data/database.sqlite';

        if (file_exists($copyPath)) {
            file_put_contents($copyPath, '');
        }
    }
}