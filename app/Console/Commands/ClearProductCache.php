<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearProductCache extends Command
{
    protected $signature = 'products:clear-cache';
    protected $description = 'Clear all product-related cache';

    public function handle()
    {
        try {
            Cache::tags(['products'])->flush();
            $this->info('Product cache cleared successfully.');
            Log::info('Product cache cleared via command');
        } catch (\Exception $e) {
            $this->error('Failed to clear product cache: ' . $e->getMessage());
            Log::error('Failed to clear product cache via command', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
