<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::with('attributes')->get();

        return response($products);
    }

    public function show($id): Response
    {
        $product = Product::with('attributes')->findOrFail($id);

        return response($product);
    }
    
    public function store(Request $request): Response
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'attributes' => 'string'
        ]);
        
        $product = Product::create([
            'name' =>  $fields['name'],
            'description' => $fields['description']
        ]);

        if ($fields['attributes']) {
            foreach (json_decode($fields['attributes'], true) as $attribute) {
                $product->attributes()->create($attribute);
            }
        }
 
        return response(['message' => 'Record created successfully']);
    }

    public function update(Request $request, $id): Response
    {
        $input = $request->all();

        $product = Product::with('attributes')->findOrFail($id);
        $product->fill($input)->save();

        $attributes = json_decode($input["attributes"], true);

        foreach ($attributes as $attribute) {
            $product->attributes()->updateOrInsert(["product_id" => $id, "key" => $attribute["key"]], ["value" => $attribute["value"]]);
        }

        return response(['message' => 'Record updated successfully']);
    }

    public function delete($id): Response
    {
        Product::findOrFail($id)->delete();
        
        return response(['message' => 'Record deleted successfully']);
    }
}
