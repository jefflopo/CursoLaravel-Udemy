@extends('layouts.app')
@section('title', 'Lista de Alunos')
@section('content')
	<h1>Alunos</h1>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{url('alunos/busca')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar por aluno.." value="{{$buscar}}">
					<span class="input-group-btn">
					  <button class="btn btn-outline-secondary" type="button">Buscar</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px">
			<form method="POST" action="{{url('alunos/ordem')}}">
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
		@foreach($alunos as $aluno)
		<div class="col-md-3">
			@if(file_exists("./img/alunos/" . $aluno->id . ".jpg"))

				<img src="{{url('img/alunos/' .$aluno->id . '.jpg')}}" alt="Imagem Aluno" class="img-fluid img-thumbnail">
				
			@endif
			<h4 class="text-center">
				Nome: {{$aluno->nome}}				
			</h4>
			<div>
				<p><strong>Matrícula: {{$aluno->id}}</strong></p>
				<p><strong>CPF: {{$aluno->cpf}}</strong></p>
				<p><strong>E-mail: {{$aluno->email}}</strong></p>
			</div>
			<br/><br/>
			<div>
				<p>Cadastro realizado em: {{$aluno->created_at}}</p>
				<p>Última alteração no cadastro: {{$aluno->updated_at}}</p>
			</div>
		</div>
		
		@endforeach
	</div>
@endsection