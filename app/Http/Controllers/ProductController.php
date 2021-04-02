<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($request->product_name))
            $query = strtoupper($request->product_name);
            return Product::where('name','LIKE','%'.$query.'%')
                        ->orWhere('reference','LIKE','%'.$query.'%')->get();

        return Product::all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $validator = $request->validated();
                
        if (empty($validator)) {
          return response()->json([ 'error'=>'Dados inválidos'], 422);
        }

        $product = new Product;
        $product->create($request->all());
        return Response()->json('Produto cadastrado!', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->productService->show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $validator = $request->validated();
                
        if (empty($validator)) {
          return response()->json([ 'error'=>'Dados inválidos'], 422);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->delivery_days = $request->delivery_days;
        $product->save();
        return Response()->json('Produto Atualizado!', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return Response()->json('Produto Excluido!', 200);

    }
}
