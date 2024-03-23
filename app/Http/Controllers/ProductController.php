<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    public function viewAll()
    {
        // $products = ProductManager::getAllProducts();
        $products = Product::all();
        return view("products")->with("products", $products);
    }

    public function details($id)
    {
        // $product = ProductManager::getProductById($id);
        $product = Product::find($id);
        return view("details")->with("product", $product);
    }

    public function add($id)
    {
        $cart = session("cart", []);
        $product = Product::findOrFail($id);
        // $product = ProductManager::getProductById($id);
        if (array_key_exists($id, $cart)) {
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
        session(["cart" => $cart]);
        return redirect("/cart");
    }

    public function cart()
    {
        $cart = session("cart", []);
        $total = 0;
        $vat = 0;
        foreach ($cart as $product) {
            $total += $product["quantity"] * $product["price"] * ($product["vat"] / 100 + 1);
            $vat += $product["quantity"] * $product["price"] * $product["vat"] / 100;
        }
        return view("cart")
            ->with("total", $total)
            ->with("vat", $vat)
            ->with("cart", $cart);
    }

    public function create()
    {
        return view("product/create");
    }

    public function store(ProductRequest $request)
    {
        // On créé le produit dans la base de données
        $product = Product::create($request->all());

        // Maintenant qu'on a l'ID du produit, on stocke l'image
        if ($request->image != null) {
            $image = $product->id . '.' . $request->image->extension();
            $request->file('image')->move(public_path('images'), $image);
            $product->image = $image;
            $product->save();
        }
        return redirect("/");
    }

    public function modify($id)
    {
        $product = Product::findOrFail($id);
        return view("product/modify")->with("product", $product);
    }

    public function update(ProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);
        $product->update($request->all());

        if ($request->image != null) {
            // On supprime l’ancienne image
            $oldPath = public_path('images') . "/" . $product->image;
            try {
                unlink($oldPath);
            } catch (\Exception $ex) {
                Log::info($ex->getMessage());
            }
            // On sauvegarde la nouvelle
            $image = $product->id . '.' . $request->image->extension();
            $request->file('image')->move(public_path('images'), $image);
            $product->image = $image;
            $product->save();
        }

        return redirect("/");
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);
        $oldPath = public_path('images') . "/" . $product->image;
        try {
            unlink($oldPath);
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
        $product->delete();
        return redirect("/");
    }
}
