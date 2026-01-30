<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddPriceToPortfolios extends Command
{
    protected $signature = 'db:add-price';
    protected $description = 'Add price column to portfolios table if it does not exist';

    public function handle()
    {
        try {
            // Check if column exists
            if (Schema::hasColumn('portfolios', 'price')) {
                $this->info('✓ Column "price" already exists in portfolios table');
                return 0;
            }

            // Add column
            Schema::table('portfolios', function ($table) {
                $table->decimal('price', 15, 2)->nullable()->after('description');
            });

            $this->info('✓ Successfully added "price" column to portfolios table');
            return 0;
        } catch (\Exception $e) {
            $this->error('✗ Error: ' . $e->getMessage());
            return 1;
        }
    }
}
