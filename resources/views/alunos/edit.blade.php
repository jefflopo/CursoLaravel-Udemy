@extends('layouts.app')
@section('title', 'Editar um Aluno - ' . $aluno->nome)
@section('content')
	<h1 class="mb-3">Editar Aluno - {{$aluno->nome}}</h1>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
	@endif
	@if(count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="POST" enctype="multipart/form-data" action="{{action('AlunosController@update', $aluno->id)}}">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
		<div class="form-group mb-3">
		    <label for="nome">Nome</label>
		    <input type="text" class="form-control" id="nome" name="nome" value="{{$aluno->nome}}" placeholder="Digite o Nome do Aluno..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="cpf">CPF</label>
		    <input type="text" class="form-control" value="{{$aluno->cpf}}" id="cpf" name="cpf" placeholder="Digite o CPF do Aluno..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="email">E-mail</label>
		   	<input type="email" class="form-control" id="email" name="email" value="{{$aluno->email}}" placeholder="Digite o E-mail do Aluno..." required>
	 	</div>
	 	<button type="submit" class="btn btn-primary">Atualizar Cadastro</button>
	</form>
@endsection