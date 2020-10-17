<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pets;
use App\Attendances;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retorno de todos os pets
        return Pets::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validação de dados
        $request->validate([
            'name_pet'=>'required|min:2',
            'id_specie'=>'required'
        ]);
        
        // adiciona um pet
        return Pets::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // seleciona/exibe um pet
        return Pets::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // atualiza pet
        $pet = Pets::find($id);
        $pet->update($request->all());
        return $pet;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendances = Attendances::all();

        foreach ($attendances as $att) {
            if($att['id_pet']==$id){
                Attendances::destroy($att['id']);
            }
        }

        // deleta pet
        return Pets::destroy($id);
    }
}
