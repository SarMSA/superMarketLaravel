<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $id; 

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->id = Auth::user()->id;
        $products = Product::where('user_id', $this->id)->latest()->paginate(4);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'name'     => $request->name,
            'price'    => $request->price,
            'details'  => $request->detail,
            'user_id'  => Auth::user()->id,
        ]);
        return redirect()->route('products.index')->with('message', 'product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return view('product.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('message', 'product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('products.index')->with('message', 'product deleted');

    }

    //trash product(softDelete)..
    public function softDeleted($id)
    {
        //
        Product::find($id)->delete();
        return redirect()->route('products.index')->with('message', 'product deleted');

    }
    //view trashed products...
    public function trashedProducts()
    {
        //
        $this->id = Auth::user()->id;
        $products = Product::where('user_id', $this->id)->onlyTrashed()->latest()->paginate(4);
        return view('product.trashed', compact('products'));

    }
    //delete trashed products
    public function deleteForEver($id)
    {
        //
        $products = Product::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('getTrashed')->with('message', 'product deleted');

    }
    //restore trashed products
    public function restoreTrashed($id)
    {
        //
        $products = Product::onlyTrashed()->where('id', $id)->first()->restore();
        return redirect()->route('products.index')->with('message', 'product restored');

    }
}
