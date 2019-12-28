<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Corrida;

class CorridaController extends Controller
{
    public function status() {
        return ['status' => 'online'];
    }
    #Methodo que cadastra uma nova corrida e deixa disponível para que motociclistas possam aceitar
    public function ready(Request $request) {
        try{
            $corrida = new Corrida();

            $corrida->id_usuario_request = $request->id_usuario_request;
            $corrida->corrida_status = $request->corrida_status;
            $corrida->corrida_distance = $request->corrida_distance;

            $corrida->corrida_time = $request->corrida_time;
            $corrida->corrida_price = $request->corrida_price;
            $corrida->rest_price = $request->rest_price;
            $corrida->price_type = $request->price_type;

            $corrida->request_lat_start = $request->request_lat_start;
            $corrida->request_long_start = $request->request_long_start;
            $corrida->request_lat_end = $request->request_lat_end;
            $corrida->request_long_end = $request->request_long_end;

            $corrida->save();

            return ['response' => '200 ok', 'msg' => 'Procurando Motociclistas.'];

        } catch(\Exception $erro) {
            return ['error' => $erro];
        }
    }
    #Pega a id do motorista que aceitou a corrida e adiciona as informações do condutor a nova corrida
    public function start(Request $request, $id){
        try{
            $corrida = Corrida::find($id);

            $corrida->id_usuario_response = $request->id_usuario_response;
            $corrida->response_lat_real = $request->response_lat_real;
            $corrida->response_long_real = $request->response_long_real;
            $corrida->response_distance = $request->response_distance;
            $corrida->response_time = $request->response_time;
            $corrida->corrida_status = $request->corrida_status;

            $corrida->save();

            return ['response' => '200 ok', 'msg' => 'Corrida Iniciada!', 'data' => $corrida];

        } catch(\Exception $erro) {
            return ['error' => $erro];
        }
    }
    #Atualiza sempre que requisitado as coordenadas geograficas e tempo de deslocamento até o ponto final da corrida
    public function checkpoint(Request $request, $id) {
        try{
            $corrida = Corrida::find($id);

            $corrida->response_lat_real = $request->response_lat_real;
            $corrida->response_long_real = $request->response_long_real;
            $corrida->response_distance = $request->response_distance;
            $corrida->response_time = $request->response_time;
            
            $corrida->save();

            return ['response' => '200 ok', 'msg' => 'Novo Checkpoint!', 'data' => $corrida];
        
        }catch(\Exception $erro){
            return ['erro' => $erro];
        }
    }
    #A Função SetPoint
    #Altera o status da corrida para "O moto taxi chegou"
    #0 = "Escolhendo Rota" 
    #1 = "Localizando Motociclista"
    #2 = "Corrida Iniciada"
    #3 = "Corrida Finalizada"
    #4 = "Corrida Cancelada Pelo Cliente"
    #5 = "Corrida Cancelada Pelo Motociclista"
    public function setpoint(Request $request, $id) {
        try{
            $corrida = Corrida::find($id);

            $corrida->corrida_status = $request->corrida_status;

            $corrida->save();

            return ['response' => '200 ok', 'msg' => 'Corrida Encerrada!', 'data' => $corrida];

        }catch(\Exception $erro) {
            return ['erro' => $erro];
        }
    }
}