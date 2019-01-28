@extends('layouts.app')
@section('title', 'Lista de Professores')
@section('content')
	<h1>Professores</h1>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{url('professores/busca')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar por professor.." value="{{$buscar}}">
					<span class="input-group-btn">
					  <button class="btn btn-outline-secondary" type="button">Buscar</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px">
			<form method="POST" action="{{url('professores/ordem')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<select id="ordem" name="ordem" class="form-control">
						<option value="0" @if($ordem == 0) selected @endif>Escolha a Ordem</option>
						<option value="1" @if($ordem == 1) selected @endif>Nome (A-Z)</option>
						<option value="2" @if($ordem == 2) selected @endif>Nome (Z-A)</option>
						<option value="3" @if($ordem == 3) selected @endif>Matrícula (Maior-Menor)</option>
						<option value="4" @if($ordem == 4) selected @endif>Matrícula (Menor-Maior)</option>
					</select>
					<span class="input-group-btn">
					  <button class="btn btn-secondary" >Ordenar</button>
					</span>
				</div>
			</form>
		</div>

	</div>

	<div class="row">
		@foreach($professores as $professor)
		<div class="col-md-3">
			@if(file_exists("./img/professores/" . $professor->id . ".jpg"))

				<img src="{{url('img/professores/' .$professor->id . '.jpg')}}" alt="Imagem Professor" class="img-fluid img-thumbnail">
				
			@endif
			<h4 class="text-center">
				Nome: {{$professor->nome}}				
			</h4>
			<div>
				<p><strong>Matrícula: {{$professor->id}}</strong></p>
				<p><strong>CPF: {{$professor->cpf}}</strong></p>
				<p><strong>E-mail: {{$professor->email}}</strong></p>
			</div>
			<br/><br/>
			<div>
				<p>Cadastro realizado em: {{$professor->created_at}}</p>
				<p>Última alteração no cadastro: {{$professor->updated_at}}</p>
			</div>
		</div>
		
		@endforeach
	</div>
@endsection