<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\{Lancamento, CentroCusto, User, Tipo};
use DateTime;

class LancamentoController extends Controller
{
    /**
     * Mostra todos os lançamentos do Usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lancamentos = Lancamento::where('id_user',Auth::user()->id_user)->orderBy('dt_faturamento','desc');

        if($request->get('pesquisar')){
            $pesquisar = '%'.$request->get('pesquisar').'%';
            $lancamentos->where('descricao','like',$pesquisar);

        }

        //Datas Inicio
        if($request->get('dt_inicio') || $request->get('dt_fim') ){
            if($request->get('dt_inicio')){
                $dt_inicio = $request->get('dt_inicio');
            }else{
                $dt = new Carbon($request->get('dt_inicio'));
                $dt->subDays(10);
                $dt_inicio = $dt;
            }
        //Data Fim
            if($request->get('dt_fim')){
                $dt_fim = $request->get('dt_fim');
            }else{
                $dt = new Carbon($dt_inicio);
                $dt->addDays(10);
                $dt_fim = $dt;
            }

            $lancamentos->whereBetween('dt_faturamento', [$dt_inicio, $dt_fim]);
        }

        return view('lancamento.index')->with(compact('lancamentos'));
    }

    /**
     * Caminho para o form de cadastro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lancamento = null;    
        $centrosDeCusto = CentroCusto::orderBy('centro_custo');
        $entradas = CentroCusto::where('id_tipo',3)->orderBy('centro_custo');
        $saidas = CentroCusto::where('id_tipo',2)->orderBy('centro_custo');

        return view('lancamento.form')->with(compact('entradas','saidas','lancamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lancamento = new Lancamento();
        $lancamento->fill($request->all());
        $lancamento->id_user = auth::user()->id_user;        
        $lancamento->save();

        return redirect()->route('lancamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $lancamento = Lancamento::find($id);
        return view('lancamento.show')
            ->with(compact('lancamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lancamento = Lancamento::find($id);
        $entradas = CentroCusto::where('id_tipo',3)->orderBy('centro_custo');
        $saidas = CentroCusto::where('id_tipo',2)->orderBy('centro_custo');
        
        return view('lancamento.form')
            ->with(compact('lancamento','entradas','saidas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $lancamento = lancamento::find($id);
        $lancamento->fill($request->all());
        $lancamento->save();

        return redirect()->route('lancamento.index')->with('success','Atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $lancamento = Lancamento::find($id);
        $lancamento->delete();

        return redirect()->back();
    }
}
