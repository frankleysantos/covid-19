@extends('layouts.app')
@section('content')
<paciente-vacinas-component :paciente="{{$paciente}}" :vacina="{{$vacina}}" :vacinado="{{$paciente_vacinado ? $paciente_vacinado : '0'}}"></paciente-vacinas-component>
@endsection