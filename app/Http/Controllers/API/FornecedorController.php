<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use App\Http\Requests\StoreUpdateFornecedorFomRequest;

class FornecedorController extends Controller
{
    private $fornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }
  
    public function index(Request $request)
    {
        $fornecedor = $this->fornecedor::with('servico')->get();

        return response()->json($fornecedor);
    }
    
    public function create()
    {
        //
    }

    public function store(StoreUpdateFornecedorFomRequest $request)
    {
        $fornecedor = $this->fornecedor->create($request->all());

        return response()->json($fornecedor,201);
    }

    public function show($id)
    {
        if(!$fornecedor = $this->fornecedor->with('servico')->find($id))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);
    
        return response()->json($fornecedor);
    }

    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $fornecedor = $this->fornecedor->find($id);
        if (!$fornecedor)
            return response()->json(['error' => 'Not found'], 404);

        $fornecedor->update($request->all());

        return response()->json($fornecedor);
    }

    
    public function destroy($id)
    {
        if (!$fornecedor = $this->fornecedor->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $fornecedor->delete();

        return response()->json(['success' => true], 204);
    }
}
