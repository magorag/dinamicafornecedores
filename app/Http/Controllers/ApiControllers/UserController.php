<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(['data'=>$users], 201);
    }

    public function registrar(Request $request){
            $dados = $request->all();
            if(!User::where('email', $dados['email'])->count()){
                $dados['password'] = bcrypt($dados['password']);
                $user = User::create($dados);
                return response()->json(['data'=>$user], 201);
            }else{
                return response()->json(['message'=>'Este e-mail já está cadastrado.'], 400);
            }
    }

    public function show($id)
    {
        if(!$user = User::find($id))
            return response()->json(['error' => 'Servico nao encontrado!'], 404);

         return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $dados = $request->all();
        $dados['password'] = bcrypt($dados['password']);
        if (!$user = User::find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $user->update($dados);
        return response()->json(['success' => true], 202);
    }

    public function destroy($id)
    {
        if (!$user = User::find($id))
            return response()->json(['error' => 'Not Found'], 404);

        $user->delete();

        return response()->json(['success' => true], 204);
    }
}
