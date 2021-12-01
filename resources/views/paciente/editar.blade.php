@extends('layouts.app')
@section('content')
<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><span class="text-muted font-weight-light"><a class="url-nav" href="{{url('paciente')}}" 
            style="color: rgb(94, 91, 91); text-decoration: none">Paciente</a></span>
        </li>
          <li class="breadcrumb-item active" aria-current="page">Edição</li>
        </ol>
    </nav>
    <editar-paciente-component 
        :p_nome="'{{$paciente->nome}}'" 
        :p_cpf="'{{$paciente->cpf}}'" 
        :p_telefone="'{{$paciente->telefone}}'" 
        :p_id="'{{$paciente->id}}'">
    </editar-paciente-component>
</div>    
@endsection