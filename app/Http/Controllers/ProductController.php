<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FakeStoreService;

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
}
