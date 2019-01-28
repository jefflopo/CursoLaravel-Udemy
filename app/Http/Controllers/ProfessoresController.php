<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Professores;
 
class ProfessoresController extends Controller
{
    public function index(){
    	$professores = Professores::all();
        
    	return view('professores.index', array('professores'=> $professores, 'buscar' => null, 'ordem' => null));
    }

    public function create(){

        if(Auth::check()){
            return view('professores.create'); 
        }else{
            return redirect('login');
        }

    	   	
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'nome'=> 'required|min:10',
    		'cpf'=> 'required|unique:professores',
    		'email'=> 'required|min:10'
    	]);

    	$professor = new Professores();
    	$professor->nome = $request->input('nome');
    	$professor->cpf = $request->input('cpf');
    	$professor->email = $request->input('email');

    	if($professor->save()){

    		return redirect('professores/create')->with('success', 'Professor Cadastrado com Sucesso!');
    	}
    }

    public function edit($id){

        if(Auth::check()){
            $professor = Professores::find($id);
            return view('professores.edit', compact('professor', $id));
        }else{
            return redirect('login');
        }
    	
    	
    }

    public function update(Request $request, $id)
    {
    	$professor = Professores::find($id);

    	$this->validate($request, [
    		'nome'=> 'required|min:10',
            'cpf'=> 'required|unique:professores',
            'email'=> 'required|min:10'
    	]);

    	if ($request->hasFile('imgprofessor')) {
    		$imagem = $request->file('imgprofessor');
    		$nomearquivo = $id . '.' . $imagem->getClientOriginalExtension();
    		$request->file('imgprofessor')->move(public_path('./img/professores/'), $nomearquivo);
    	}

    	$professor->nome = $request->get('nome');
    	$professor->cpf = $request->get('cpf');
    	$professor->email = $request->get('email');

    	if($professor->save()){

    		return redirect('professores/'.$id. '/edit')->with('success', 'Cadastro de Professor Atualizado com Sucesso!');
    	}
    }

    public function destroy($id){
    	$professor = Professores::find($id);
    	$professor->delete();
    	if(file_exists("./img/professores/" . md5($id) . ".jpg")){
    		unlink("./img/professores/" . md5($id) . ".jpg");
    	}

    	return redirect()->back()->with('success', 'Cadastro de Professor Excluído com Sucesso!');
    }

    public function busca(Request $request){
    	$buscaInput = $request->input('busca');
    	$professores = Professores::where('nome', 'LIKE', '%'.$buscaInput.'%')->paginate(4);

    	return view('professores.index', array('professores'=> $professores, 'buscar' => $buscaInput, 'ordem' => null));
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
        $professores = Professores::orderBy($campo, $tipo)->paginate(4);

        return view('professores.index', array('professores'=> $professores, 'buscar'=> null, 'ordem' => $ordemInput));
    }
}
