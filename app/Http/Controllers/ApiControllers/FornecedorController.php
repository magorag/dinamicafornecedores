<?php

namespace App\Http\Controllers\ApiControllers;

use App\Fornecedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FornecedoresRequest;

class FornecedorController extends Controller
{
    private $fornecedor;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->fornecedor = $fornecedor;
    }

    public function index()
    {

        $fornecedor = $this->fornecedor::with('estado')->get();

        return response()->json($fornecedor);
    }

    public function store(Request $request)
    {
        if(!$fornecedor = $this->fornecedor->create($request->all()))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);

        return response()->json($fornecedor,201);
    }

    public function show($id)
    {
        if(!$fornecedor = $this->fornecedor->with('estado')->find($id))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);

        return response()->json($fornecedor, 200);
    }

    public function update(Request $request, $id)
    {
        $fornecedor = $this->fornecedor->find($id);

        if (!$fornecedor)
            return response()->json(['error' => 'Not found'], 404);

        $fornecedor->update($request->all());

        return response()->json($fornecedor, 200);
    }


    public function destroy($id)
    {
        if (!$fornecedor = $this->fornecedor->find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $fornecedor->delete();

        return response()->json(['success' => true], 204);
    }
}
