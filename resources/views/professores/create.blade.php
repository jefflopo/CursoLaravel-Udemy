@extends('layouts.app')
@section('title', 'Cadastrar Professor')
@section('content')
	<h1 class="mb-3">Cadastrar um Novo Professor</h1>
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
	<form method="POST" action="{{url('professores')}}">
		{{ csrf_field() }}
		<div class="form-group mb-3">
		    <label for="nome">Nome</label>
		    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome do Professor..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="cpf">CPF</label>
		    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF do Professor..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="email">E-mail</label>
		   	<input type="email" class="form-control" id="email" name="email" placeholder="Digite o E-mail do Professor..." required>
	 	</div>
	 	<button type="submit" class="btn btn-primary">Cadastrar Professor</button>
	</form>
@endsection