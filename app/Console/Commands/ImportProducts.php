<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Models\Product;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from a CSV file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');
        
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv->getRecords() as $record) {
            Product::create([
                'name' => $record['Name'],
                'description' => $record['Description'],
                'price' => $record['Price'],
            ]);
        }

        $this->info('Products imported successfully!');
    }
}
