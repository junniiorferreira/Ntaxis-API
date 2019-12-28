<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Usuario;

class UsuarioController extends Controller
{
    public function status() {
        return ['status' => 'ok'];
    }
    public function add(Request $request) {
        try{
            $usuario = new Usuario();

            $usuario->nome = $request->nome;
            $usuario->telefone = $request->telefone;
            $usuario->email = $request->email;

            $usuario->save();

            return ['response' => '200 ok'];

        } catch(\Exception $erro) {
            return ['error' => $erro];
        }
    }
    public function quicklist() {
        $usuarios = Usuario::all('id', 'nome');

        return $usuarios;
    }
    public function list() {
        $usuarios = Usuario::all();

        return $usuarios;
    }
    public function select($id) {
        $usuario = Usuario::find($id);

        return $usuario;
    }
    public function update(Request $request, $id) {
        try{
            $usuario = Usuario::find($id);

            $usuario->nome = $request->nome;
            $usuario->telefone = $request->telefone;

            $usuario->save();

            return ['response' => '200 ok', 'data' => $usuario];

        } catch(\Exception $erro) {
            return ['error' => $erro];
        }        
    }
    public function delete(Request $request, $id) {
        try{
            $usuario = Usuario::find($id);

            $usuario->delete();

            return ['response' => 'Usuário Apagado'];

        } catch(\Exception $erro) {
            return ['error' => $erro];
        }        
    }    
}