<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retorno de todos os atendimentos
        return Attendances::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /// validação de dados de atendimento
        $request->validate([
            'data'=>'required',
            'id_pet'=>'required'
        ]);

        // é preciso formatar a data
        // $start_day = date("Y-m-d", strtotime($start_day_old));

        // adiciona um atendimento
        return Attendances::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // seleciona/exibe um atendimento
        return Attendances::find($id);
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
        /// atualiza o atendimento
        $attendance = Attendances::find($id);

        // é preciso formatar a data ao atualizar
        // $start_day = date("Y-m-d", strtotime($start_day_old));

        $attendance->update($request->all());
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // deleta o atendimento
        return Attendances::destroy($id);
    }
}
