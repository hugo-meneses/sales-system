<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\SaleRequest;
use App\Services\SaleService;

class SaleController extends Controller
{

    protected $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = $this->saleService->getAll(); 
        
        if(isset($request->per_page))
            $per_page = $request->per_page;
        else 
            $per_page = 20;
        
        return Sale::with('products:name,delivery_days')->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(SaleRequest $request)
    {
        $validator = $request->validated();
                
        if (empty($validator)) {
          return response()->json([ 'error'=>'Dados inválidos'], 422);
        }
    
        $sale = new Sale;
        $sale->purchase_at = Carbon::parse($request->purchase_at);
        $sale->amount = $request->amount;
        $sale->delivery_days = $request->delivery_days;
        $sale->save();
        $sale->products()->sync($request->products);
        return Response()->json(['message'=>'Venda Concluida com sucesso!'], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->saleService->show($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequest $request, $id)
    {
        $validator = $request->validated();
                
        if (empty($validator)) {
          return response()->json([ 'error'=>'Dados inválidos'], 422);
        }
        
        $sale = Sale::find($id);
        $sale->purchase_at = Carbon::parse($request->purchase_at);
        $sale->save();
        $sale->products()->sync($request->products);
        return Response()->json('Venda Alterada com sucesso!', 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->products()->detach();
        $sale->delete();
        return Response()->json('Venda Excluida com sucesso!', 200);
    }
}
