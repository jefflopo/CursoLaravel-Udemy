@extends('layouts.app')
@section('title', 'Lista de Produtos')
@section('content')
	<h1>Produtos</h1>
	@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
	@endif
	<div class="row">
		<div class="col-md-12">
			<form method="POST" action="{{url('produtos/busca')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<input type="text" class="form-control" id="busca" name="busca" placeholder="Procurar produto no site.." value="{{$buscar}}">
					<span class="input-group-btn">
					  <button class="btn btn-outline-secondary" type="button">Buscar</button>
					</span>
				</div>
			</form>
		</div>
		<div class="col-md-12" style="margin-top: 10px; margin-bottom: 10px">
			<form method="POST" action="{{url('produtos/ordem')}}">
				{{ csrf_field() }}
				<div class="input-group">
					<select id="ordem" name="ordem" class="form-control">
						<option>Escolha a Ordem</option>
						<option value="1" @if($ordem == 1) selected @endif>Título (A-Z)</option>
						<option value="2" @if($ordem == 2) selected @endif>Título (Z-A)</option>
						<option value="3" @if($ordem == 3) selected @endif>Valor (Maior-Menor)</option>
						<option value="4" @if($ordem == 4) selected @endif>Valor (Menor-Maior)</option>
					</select>
					<span class="input-group-btn">
					  <button class="btn btn-outline-secondary" >Ordenar</button>
					</span>
				</div>
			</form>
		</div>

	</div>

	<div class="row">
		@foreach($produtos as $produto)
		<div class="col-md-3">
			@if(file_exists("./img/produtos/" . md5($produto->id) . ".jpg"))

				<img src="{{url('img/produtos/' .md5($produto->id) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
				
			@endif
			<h4 class="text-center">
				<a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->titulo}}</a>
			</h4>
			<p class="text-center">R$ {{number_format($produto->preco, 2, ',', '.')}}</p>
			@if(Auth::check())
			<div class="mb-3">
				<form method="POST" enctype="multipart/form-data" action="{{action('ProdutosController@destroy', $produto->id)}}">
					{{ csrf_field() }}
					<input type="hidden" name="_method" value="DELETE">
					<a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-primary">Editar</a>
					<button class="btn btn-danger">Excluir</button>
				</form>
			</div>
			@endif
		</div>
		
		@endforeach
	</div>
	{{$produtos->links()}}
@endsection