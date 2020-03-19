<?php

namespace App\Http\Controllers\ApiControllers;

use App\Estado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    private $servico, $totalPage = 30;

    public function __construct(Estado $servico)
    {
        $this->servico = $servico;
    }

    public function index(Request $request)
    {
        $servicos = $this->servico->getResults($request->estado);

        return response()->json($servicos);
    }

    public function show($id)
    {
        if(!$servico = $this->servico->find($id))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);

        return response()->json($servico);
    }

    public function store(Request $request)
    {
        $servico = $this->servico->create($request->all());

        return response()->json($servico, 201);
    }

    public function update(Request $request, $id)
    {
        $servico = $this->servico->find($id);
        if(!$servico)
            return response()->json(['error'=>'Servico nao encontrado!'], 404);

        $servico->update($request->all());

        return response()->json($servico);
    }
    public function destroy($id)
    {
        if(!$servico = $this->servico->find($id))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);

        $servico->delete();

        return response()->json(['sucess'=>true], 204);
    }
    public function fornecedors($id)
    {
        if (!$servico = $this->servico->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $fornecedors = $servico->fornecedors()->paginate($this->totalPage);

        return response()->json([
            'servico' => $servico,
            'fornecedors' => $fornecedors,
        ]);
    }
}
