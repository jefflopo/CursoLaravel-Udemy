<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Alunos;
 
class AlunosController extends Controller
{
    public function index(){
    	$alunos = Alunos::all();
        
    	return view('alunos.index', array('alunos'=> $alunos, 'buscar' => null, 'ordem' => null));
    }

    public function create(){

        if(Auth::check()){
            return view('alunos.create'); 
        }else{
            return redirect('login');
        }
    	   	
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'nome'=> 'required|min:10',
    		'cpf'=> 'required|unique:alunos',
    		'email'=> 'required|min:10'
    	]);

    	$aluno = new Alunos();
    	$aluno->nome = $request->input('nome');
    	$aluno->cpf = $request->input('cpf');
    	$aluno->email = $request->input('email');

    	if($aluno->save()){

    		return redirect('alunos/create')->with('success', 'Aluno Cadastrado com Sucesso!');
    	}
    }

    public function edit($id){
    	if(Auth::check()){
            $aluno = Alunos::find($id);
            return view('alunos.edit', compact('aluno', $id));
        }else{
            return redirect('login');
        }
    }

    public function update(Request $request, $id)
    {
    	$aluno = Alunos::find($id);

    	$this->validate($request, [
    		'nome'=> 'required|min:10',
            'cpf'=> 'required|unique:alunos',
            'email'=> 'required|min:10'
    	]);

    	if ($request->hasFile('imgaluno')) {
    		$imagem = $request->file('imgaluno');
    		$nomearquivo = $id . '.' . $imagem->getClientOriginalExtension();
    		$request->file('imgaluno')->move(public_path('./img/alunos/'), $nomearquivo);
    	}

    	$aluno->nome = $request->get('nome');
    	$aluno->cpf = $request->get('cpf');
    	$aluno->email = $request->get('email');

    	if($aluno->save()){

    		return redirect('alunos/'.$id. '/edit')->with('success', 'Cadastro de Aluno Atualizado com Sucesso!');
    	}
    }

    public function destroy($id){
    	$aluno = Alunos::find($id);
    	$aluno->delete();
    	if(file_exists("./img/alunos/" . md5($id) . ".jpg")){
    		unlink("./img/alunos/" . md5($id) . ".jpg");
    	}

    	return redirect()->back()->with('success', 'Cadastro de Aluno Excluído com Sucesso!');
    }

    public function busca(Request $request){
    	$buscaInput = $request->input('busca');
    	$alunos = Alunos::where('nome', 'LIKE', '%'.$buscaInput.'%')->paginate(4);

    	return view('alunos.index', array('alunos'=> $alunos, 'buscar' => $buscaInput, 'ordem' => null));
    }

    public function ordem(Request $request)
    {
        $ordemInput = $request->input('ordem');
        if($ordemInput == 0){
            $campo = 'nome';
            $tipo = 'asc';
        } else if($ordemInput == 1){
            $campo = 'nome';
            $tipo = 'desc';
        } else if($ordemInput == 2){
            $campo = 'nome';
            $tipo = 'asc';
        } else if($ordemInput == 3){
            $campo = 'id';
            $tipo = 'desc';
        } else if($ordemInput == 4){
            $campo = 'id';
            $tipo = 'asc';
        }
        $alunos = Alunos::orderBy($campo, $tipo)->paginate(4);

        return view('alunos.index', array('alunos'=> $alunos, 'buscar'=> null, 'ordem' => $ordemInput));
    }
}
