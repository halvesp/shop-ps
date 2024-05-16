<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Writer;
use App\Models\Product; 
use SplTempFileObject;

class ExportProducts extends Command
{
    protected $signature = 'export:products';
    protected $description = 'Export products to a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $products = Product::all();

        $csv = Writer::createFromFileObject(new SplTempFileObject());

        $csv->insertOne(['ID', 'Name', 'Description', 'Price']);

        foreach ($products as $product) {
            $csv->insertOne([$product->id, $product->name, $product->description, $product->price]);
        }

        $csv->output('products.csv');

        $this->info('Products exported successfully!');
    }
}
