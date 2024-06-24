<?php

namespace App\Http\Controllers;

use App\Http\Requests\CorretorRequest;
use Illuminate\Http\Request;

use App\Models\Corretor;


class CorretorController extends Controller
{

    private $corretor;

     public function __construct()
     {
        $this->corretor = new Corretor();
     }

    public function index() {

        $corretores = Corretor::all();
       

        return view("index", [
            "corretores" => $corretores
        ]);
    }

    public function store(CorretorRequest $request) {

        $cpf = preg_replace('/\D/', '', $request->cpf);

       $registeredCPF = $this->corretor->where('cpf', $cpf)->exists();
       $registeredCRECI = $this->corretor->where('creci', $request->creci)->exists();

       if($registeredCPF) {
            return back()->with('error', 'CPF já registrado, tente novamente!');
       }

       if($registeredCRECI) {
            return  back()->with('error', 'CRECI já registrado, tente novamente');
       }

       $register = $this->corretor->create([
            'cpf' => $cpf,
            'creci' => $request->creci,
            'name' => $request->name
       ]);

       if(!$register) {
           return back()->with('error', 'Erro ao tentar cadastrar'); 
       }

       return back()->with('success', 'Corretor cadastrado com sucesso!');
    }

    public function edit($id) {

        $corretor = Corretor::findOrFail($id);

        return view('edit-corretor', ['corretor' => $corretor]);
    }

    public function update(CorretorRequest $request, $id) {

        $cpf = preg_replace('/\D/', '', $request->cpf);

        $registeredCPF = $this->corretor
        ->where('cpf', $cpf)
        ->where('id', '<>', $request->id)
        ->exists();
        
        $registeredCRECI = $this->corretor
        ->where('creci', $request->creci)
        ->where('id', '<>', $request->id)
        ->exists();
 
        if ($registeredCPF) {
            return back()->with('error', 'CPF já registrado, tente novamente');
        }

        if ($registeredCRECI) {
            return back()->with('error', 'CRECI já registrado, tente novamente');
        }

        Corretor::findOrFail($id)->update([
            'cpf' => $cpf,
            'creci' => $request->creci,
            'name' => $request->name
        ]);

        $response = redirect('/')->with('success', 'Corretor editado com sucesso');

        return $response;
    }

    public function destroy($id) {

        $corretor = Corretor::findOrFail($id);

        if($corretor) {
            $corretor->delete();
            return back()->with('success', 'Corretor deletado com sucesso!');
        }
                
        return back()->with('error', 'Corretor não encontrado!');
    }
}
