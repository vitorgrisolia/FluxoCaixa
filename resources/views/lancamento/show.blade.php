@extends('layouts.base')

@section('conteudo')

    <h1>Tipo: </h1>
    <ol>
        <td>{{ $lancamento->id_lancamento                 }}</td>
        <td>{{ $lancamento->dt_faturamento->format('d/m/Y')      }}</td>
        <td>{{ $lancamento->valor                         }}</td>
        <td>{{ $lancamento->centroCusto->tipo->tipo       }}</td>
        <td>{{ $lancamento->centroCusto->centro_custo     }}</td>
        <td>{{ $lancamento->descricao                     }}</td>
        <td>{{ $lancamento->created_at->format('d/m/Y')}}</td>
        <td>{{ $lancamento->updated_at->format('d/m/Y')    }}</td>
    </ol>
    
@endsection