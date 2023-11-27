<?php

namespace App\Http\Controllers\API\V1\Products;

use App\Http\Controllers\Controller;
use App\Models\API\V1\Products\productsModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
class ProductController extends Controller
{
    //
     //get products

     public function getProducts(): jsonResponse
     {






         try {

             //fetch store products
             $products =  productsModel::all();

             if (count($products) > 0) {
                 //send json res 200 with the data
                 return response()->json($products, 200);
                 # code...
             } else {
                 # code...
                 return response()->json(["message" => "No product uploaded yet"], 404);
             }
         } catch (RuntimeException $e) {

             return response()->json(['error' => $e->getMessage()], 500);
         } catch (ModelNotFoundException $e) {
             return response()->json(['error' => $e->getMessage()], 404);
         }
     }


     public function saveProducts(Request $request)
     {



         return response()->json("");
     }
}
