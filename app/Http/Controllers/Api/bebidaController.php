<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class barController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosBebidas = Bebida::all();

        return 'Bebidas encontradas: '.$dadosBebidas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosBebidas = $request->All();
        $valida = Validator::make($dadosBebidas,[
            'bebida' => 'required',
            'nome' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistrosBebidas = Noticias::create($dadosBebidas);
        if($RegistrosBebidas){
            return 'Dados cadastros com sucesso.';
        }else{  
            return 'Dados não cadastrados no banco de dados';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dadosBebidas = Bebida::find($id);
        $contador = $dadosBebidas->count();

        if($dadosBebidas){
            return 'Bebidas encontradas: '.$contador.' - '.$dadosBebidas.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Bebidas Não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosBebidas =  $request->all();

        $valida = validator::make($dadosBebidas,[
            'bebida' => 'required',
            'nome' => 'required'
        ]);

        if($valida->fails()){
            return "Erro validação!!".$valida->$errors();
        }
        $dadosBebidasBanco = Bebida::find($id);
        $dadosBebidasBanco->bebida = $dadosBebidas['bebida'];
        $dadosBebidasBanco->nome = $dadosBebidas['nome'];

        $enviarNoticias = $dadosNoticiasBanco->save();

        if($enviarBebida){
            return 'A Bebida foi alterada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A Bebida Não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dadosBebidas = Bebida::find($id);
        if($dadosBebidas){
            $dadosBebidas->delete();
            return 'A bebida foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A bebida Não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }
}
