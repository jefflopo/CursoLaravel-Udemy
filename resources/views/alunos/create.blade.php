@extends('layouts.app')
@section('title', 'Cadastrar um Aluno')
@section('content')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cpf").mask("999.999.999-99");
		});
	</script>
	<h1 class="mb-3">Cadastrar um novo Aluno</h1>
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
	<form method="POST" action="{{url('alunos')}}">
		{{ csrf_field() }}
		<div class="form-group mb-3">
		    <label for="nome">Nome</label>
		    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome do Aluno..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="cpf">CPF</label>
		    <input type="text" class="form-control cpf-mask" id="cpf" name="cpf" placeholder="Digite o CPF do Aluno..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="email">E-mail</label>
		   	<input type="email" class="form-control" id="email" name="email" placeholder="Digite o E-mail do Aluno..." required>
	 	</div>
	 	<button type="submit" class="btn btn-primary">Cadastrar Aluno</button>
	</form>
@endsection