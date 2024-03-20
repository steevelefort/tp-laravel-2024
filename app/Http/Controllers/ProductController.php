<?php

namespace App\Http\Controllers;

use App\Models\ProductManager;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function viewAll() {
        $products = ProductManager::getAllProducts();
        return view("products")->with("products",$products);
    }

    public function details($id) {
        $product = ProductManager::getProductById($id);
        return view("details")->with("product",$product);
    }

    public function add($id) {
        $cart = session("cart",[]);
        $product = ProductManager::getProductById($id);
        if (array_key_exists($id,$cart)) {
            $cart[$id]["quantity"]++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "image" => $product->image,
                "price" => $product->price,
                "vat" => $product->vat,
                "quantity" => 1
            ];
        }
        session(["cart"=>$cart]);
        return redirect("/cart");
    }

    public function cart() {
        $cart = session("cart",[]);
        $total = 0;
        $vat = 0;
        foreach ($cart as $product) {
           $total+= $product["quantity"]*$product["price"]*($product["vat"]/100+1);
           $vat+= $product["quantity"]*$product["price"]*$product["vat"]/100;
        }
        return view("cart")
            ->with("total",$total)
            ->with("vat",$vat)
            ->with("cart",$cart);
    }

}
