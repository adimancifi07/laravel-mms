<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('vite:clear', function () {
    $buildDirectories = [public_path('build'), ...File::glob(public_path('build-*'))];
    $deletedDirectories = 0;

    foreach ($buildDirectories as $directory) {
        if (File::isDirectory($directory) && File::deleteDirectory($directory)) {
            $deletedDirectories++;
            $this->line("Deleted: {$directory}");
        }
    }

    $this->info("Deleted {$deletedDirectories} build director(s).");
})->purpose('Delete Vite build directories from the public directory');

Artisan::command('logs:clear', function () {
    $logFiles = File::files(storage_path('logs'));
    $clearedFiles = 0;

    foreach ($logFiles as $logFile) {
        if ($logFile->getExtension() !== 'log') {
            continue;
        }

        File::put($logFile->getPathname(), '');
        $clearedFiles++;
        $this->line("Cleared: {$logFile->getPathname()}");
    }

    $this->info("Cleared {$clearedFiles} log file(s).");
})->purpose('Clear application log files');
