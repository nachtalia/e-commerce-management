<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticatedController extends Controller
{
   public function products()
   {
      return Inertia::render('Products');
   }
}
