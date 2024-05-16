<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class FakeStoreService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://fakestoreapi.com/'
        ]);
    }

    public function createProduct($product)
    {
        try {
            $response = $this->client->post('products', [
                'json' => $product
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateProduct($id, $product)
    {
        try {
            $response = $this->client->put("products/{$id}", [
                'json' => $product
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteProduct($id)
    {
        try {
            $response = $this->client->delete("products/{$id}");

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getProducts()
    {
        try {
            $response = $this->client->get('products');
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
