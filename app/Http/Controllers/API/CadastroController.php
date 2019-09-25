<?php

namespace App\Http\Controllers\API;

use App\Models\Cadastro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CadastroController extends Controller
{
    private $cadastro;

    public function __construct(Cadastro $cadastro)
    {
        $this->cadastro = $cadastro;
    }

    public function index()
    {
        return view('geradorDeUrl');
    }

    public function store(Request $request)
    {
        $hash = new Cadastro;
        $gerandoHash = $request->input('hash');
        $gerandoHash = Hash::make($gerandoHash, [
            'rounds' => 12
        ]);
        $ajustandoPassword = str_replace('/', 'e', $gerandoHash);
        $hash->hash = $ajustandoPassword;
        $hash->save();

        return response()->json(array('success' => true, 'last_insert_hash' => $hash->hash), 200);
    }

    public function id($hash)
    {
        $cadastros = Cadastro::where('hash','LIKE', "{$hash}")->get();

        if(isset($cadastros[0])){
            if($cadastros[0]->cadastrado==false){
                return response()->json($cadastros);
            } else {
                return 'Cadastro já realizado';
            }
        } else{
            return 'Pagina não encontrada';
        }
    }

    public function update(Request $request, $id)
    {
        $cadastrado = $this->cadastro->find($id);
        if(!$cadastrado)
            return response()->json(['error'=> 'Servico nao encontrado'], 404);

        $cadastrado->update($request->all());

        return response()->json($cadastrado);
    }
}
