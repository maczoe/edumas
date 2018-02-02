<?php

namespace App\Http\Controllers\maintenances;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('maintenances/products', ['products' => $products]);
    }
    
     public function show($id) {
        $product = Product::findOrFail($id);
        return view('maintenances/productshow')->withProduct($product);
    }
    
    public function create() {
        $product = new Product();
        return view('maintenances/productcreate')->withProduct($product);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            "code" => "required|min:3|max:50|unique:products",
            "barcode" => "min:15|unique:products",
            "name" => "required|min:3|max:100",
            "cost" => "required|numeric|min:0",
            "price" => "required|numeric|min:0"
        ]);
        
        $input = $request->all();
        
        Product::create($input);
        
        Session::flash('alert', 'Producto creado con éxito');
        
        return redirect()->back();
    }
    
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('maintenances/productedit')->withProduct($product);
    }
    
    public function update($id, Request $request) {
        $product = Product::findOrFail($id);
        $this->validate($request, [
            "code" => "required|min:5|max:50|unique:products,code,".$product->id,
            "barcode" => "min:15|unique:products,barcode,".$product->id,
            "name" => "required|min:5|max:100",
            "cost" => "required|numeric|min:0",
            "price" => "required|numeric|min:0"
        ]);
        
        $input = $request->all();
        
        $product->fill($input)->save();
        
        Session::flash('alert', 'Producto actualizado con éxito');
        
        return redirect()->back();
    }
    
    public function destroy($id) {
        $product = Product::findOrFail($id);
        
        $product->delete();
        
        Session::flash('alert', 'Producto eliminado con éxito');
        
        return redirect()->route('products.index');
    }
}
