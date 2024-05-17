<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FakeStoreService;
use League\Csv\Reader;
use League\Csv\Writer;
use SplTempFileObject;
use App\Models\Product;

class ProductController extends Controller
{
    protected $fakeStoreService;

    public function __construct(FakeStoreService $fakeStoreService)
    {
        $this->fakeStoreService = $fakeStoreService;
    }

    public function create(Request $request)
    {
        $product = $request->all();
        $result = $this->fakeStoreService->createProduct($product);

        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $product = $request->all();
        $result = $this->fakeStoreService->updateProduct($id, $product);

        return response()->json($result);
    }

    public function delete($id)
    {
        $result = $this->fakeStoreService->deleteProduct($id);

        return response()->json($result);
    }

    public function index()
    {
        $products = $this->fakeStoreService->getProducts();
        return response()->json($products);
    }

    public function importProducts()
    {
        $products = $this->fakeStoreService->importProductsFromFakeAPI();
        return response()->json(['products' => $products]);
    }

    public function exportProducts()
    {
        $products = $this->fakeStoreService->getProducts();

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne(['ID', 'Title', 'Description', 'Price', 'Category', 'Image']);
        
        foreach ($products as $product) {
            $csv->insertOne([$product['id'], $product['title'], $product['description'], $product['price'], $product['category'], $product['image']]);
        }

        return response((string) $csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ]);
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        
        $records = $csv->getRecords();

        foreach ($records as $record) {
            Product::create([
                'title' => $record['Title'],
                'description' => $record['Description'],
                'price' => $record['Price'],
                'category' => $record['Category'],
                'image' => $record['Image']
            ]);
        }

        return response()->json(['message' => 'Products imported successfully']);
    }

}
