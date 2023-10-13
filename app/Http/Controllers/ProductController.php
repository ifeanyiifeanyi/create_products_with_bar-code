<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProductController extends Controller
{
    public function generatePdf()
    {
        $products = Product::latest()->get(); 
        

        $pdf = new Dompdf();
        $pdf->setOptions(new Options([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
            'isFontSubsettingEnabled' => true,
        ]));
        $pdf->loadHtml(View::make('products.index', compact('products'))->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream('product_list.pdf');
    }



    public function index()
    {
        $products = Product::latest()->get();

        return view("products.index", compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:products',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        $number = mt_rand(1000000000000, 9999999999999);
        if ($this->productCodeExists($number)) {
            $number = mt_rand(1000000000000, 9999999999999);
        }
        $request['product_code'] = $number;
        Product::create($request->all());
        return redirect()->route('product.name')->with("status", "New product created");
    }

    public function productCodeExists($number)
    {
        return Product::whereProductCode($number)->exists();
    }

    public function edit($id)
    {
            $product = Product::findOrFail($id);
            return view("products.edit", compact('product'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        return redirect()->route('product.name')->with("status", "Product Updated!!");


    }

    public function destroy($id){
        Product::findOrFail($id)->delete();
        return redirect()->route('product.name')->with("status", "Product Deleted!!");
    }

    public function destroyAll(Request $request){
        Product::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => "products deleted"]);
    }
}
