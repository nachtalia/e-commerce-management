<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductsController extends Controller
{
   public function index()
   {
      try {
         $products = Product::with('inventory', 'category')->paginate(5);

         return Inertia::render('Inventory', [
            'product' => $products,
         ]);
      } catch (\Exception $e) {
         return Inertia::render('Inventory', [
            'product' => [],
            'error' => 'Failed to load products. Please try again later.',
         ]);
      }
   }

   public function create(Request $request)
   {
      $validator = $request->validate([
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
         'price' => 'required|numeric|min:0',
         'category' => 'required|string|max:64',
         'stock' => 'required|integer|min:0',
      ]);

      $category = Category::create([
         'name' => $request->category
      ]);

      $Product = Product::create([
         'name' => $request->name,
         'description' => $request->description,
         'price' => $request->price,
         'stock' => $request->stock,
         'category_id' => $category->id,
      ]);

      Inventory::create([
         'product_id' => $Product->id,
         'stock' => $request->stock
      ]);
   }

   public function update(Request $request, string $id)
   {
      $validator = Validator::make($request->all(), [
         'name' => 'required|string|max:255',
         'description' => 'nullable|string',
         'price' => 'required|numeric|min:0',
         'category' => 'required|string|max:64',
         'stock' => 'required|integer|min:0',
      ]);

      if ($validator->fails()) {
         return redirect()->back()
            ->withErrors($validator)
            ->withInput();
      }

      try {
         $product = Product::findOrFail($id);

         $category = Category::firstOrCreate([
            'name' => $request['category'],
         ]);

         $product->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $category->id,
         ]);

         $inventory = $product->inventory;
         $inventory->update([
            'stock' => $request['stock'],
         ]);

         return redirect()->route('inventory')->with('success', 'Product updated successfully!');
      } catch (\Exception $e) {
         return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
      }
   }

   public function destroy(string $id)
   {
      try {
         $product = Product::with(['inventory', 'category'])->findOrFail($id);

         if ($product->inventory) {
            $product->inventory()->delete();
         }

         $category = $product->category;

         $product->forceDelete();

         if ($category) {
            $otherProducts = Product::where('category_id', $category->id)->where('id', '!=', $product->id)->exists();

            if (!$otherProducts) {
               $category->delete();
            }
         }

         return redirect()->route('inventory')->with('success', 'Product and its associated category deleted successfully!');
      } catch (\Exception $e) {
         return redirect()->route('inventory')->with('error', 'Failed to delete product: ' . $e->getMessage());
      }
   }
}
