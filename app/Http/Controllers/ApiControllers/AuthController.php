<?php

namespace App\Http\Controllers\ApiControllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'], 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse( $tokenResult->token->expires_at )->toDateTimeString(),
        ]);
    }

    public function update(Request $request, $id) {


        $user = User::all()->find($id);
        dd($user);

//        if ( !Request::input('password') == '') // verifica se a senha foi alterada
//        {
//            $user->password = bcrypt(Request::input('password')); // muda a senha do seu usuario já criptografada pela função bcrypt
//        }
//
//        $user->save(); // salva o usuario alterado =)
//
//        Flash::message('Atualizado com sucesso!');
//        return Redirect::to(...); // redireciona pra rota que você achar melhor =)
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' =>
            'Successfully logged out']);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function userupdate(Request $request, $id)
    {
        $request->validate([
            'name'     => 'string',
            'email'    => 'string|email|unique:users',
            'password' => 'string|confirmed',
        ]);

        $user = User::find($id);

        if (!$user)
            return response()->json(['error' => 'Not found'], 404);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->password !== "") {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        return response()->json($user, 200);
    }
}
