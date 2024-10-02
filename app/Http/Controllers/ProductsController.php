<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductsController extends Controller
{
   public function index()
   {
      /** TODO:
       *  - implement validation
       *  - return all products
       *  - handle success & error response
       */
   }

   public function create(Request $request)
   {
      /** TODO:
       *  - implement validation
       *  - create a new product
       *  - handle success & error response
       */
   }

   public function update(Request $request, string $id)
   {
      /** TODO:
       *  - implement validation
       *  - update an existing product
       *  - handle success & error response
       */
   }

   public function destroy(string $id)
   {
      /** TODO:
       *  - implement validation
       *  - delete an existing product
       *  - handle success & error response
       */
   }
}
