<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;
use DB;
use DataTables;
use App\Http\Requests\PeopleCreateRequest;
use App\Http\Requests\UpdatePeopleRequest;

class PeopleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalPessoas = People::count();
        $totalVotos = People::sum('votos');
        $totalUser = User::count();
        return view('peoples.list', compact('totalVotos','totalUser', 'totalPessoas'));
    }

    public function getPeoples()
    {
        $data = People::latest()->get();
        return Datatables::of($data)
        ->addColumn('data_nascimento', function($row){
           $dataNascimento =  \Carbon\Carbon::parse($row['data_nascimento'])->format('d/m/Y');

           return $dataNascimento;
        })
        ->addColumn('action', function($row){
            $actionBtn = '<a href="'.route('edit.people', $row['id']).'" target="_blank" class="edit btn btn-success btn-sm">Ver/Editar Pessoa</a>';
            if(auth()->user()->role_id == 1){
                $actionBtn.= '<a href="'.route('destroy.people', $row['id']).'" class="delete btn btn-danger btn-sm">Delete</a>';

            }
            return $actionBtn;
        })
        ->rawColumns(['action', 'data_nascimento'])
        ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peoples.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleCreateRequest $request,People $people )
    {


        try {
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;
    
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));
    
            // Recupera a extensão do arquivo
            $extension = $request->file->extension();
    
            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";
    
            // Faz o upload:
            $upload = $request->file->storeAs('public/peoples', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
    
            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload ){
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();
            }
            $dados = $request->all();
            $dados['file'] =  $nameFile;

            DB::beginTransaction();
            $response = $people->create($dados);
            if($response){
                DB::commit();
                return redirect()->back()
                ->with('success', 'Cadastrado com sucesso')
                ->withInput();
            }
            DB::rollBack();
            return redirect()->back()
            ->with('error', 'Falha ao realizar o cadastro')
            ->withInput();
        }

        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect()->back()
            ->with('error', 'Falha ao realizar o cadastro')
            ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = People::find($id);
        if($people)
            return view('peoples.edit', compact('people'));
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, People $people)
    {
        try {
            // Define o valor default para a variável que contém o nome da imagem 
            $nameFile = null;
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('file') && $request->file('file')->isValid()) {
                
                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = uniqid(date('HisYmd'));
        
                // Recupera a extensão do arquivo
                $extension = $request->file->extension();
        
                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";
        
                // Faz o upload:
                $upload = $request->file->storeAs('public/peoples', $nameFile);
                // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao
        
                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if ( !$upload ){
                    return redirect()
                                ->back()
                                ->with('error', 'Falha ao fazer upload')
                                ->withInput();
                }
            }
                $dados = $request->all();
                if(!is_null($nameFile)){
                    $dados['file'] =  $nameFile;
                }
    
                DB::beginTransaction();
                $p = $people->find($dados['id']);
                $response = $p->update($dados);
                if($response){
                    DB::commit();
                    return redirect()->back()
                    ->with('success', 'Atualizado com sucesso')
                    ->withInput();
                }
                DB::rollBack();
                return redirect()->back()
                ->with('error', 'Falha ao Atualizar')
                ->withInput();
    
            } catch (\Throwable $th) {
    
                DB::rollBack();
                return redirect()->back()
                ->with('error', 'Falha ao Atualizar')
                ->withInput();
            }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $people = People::find($id);
        if($people)
            try {
                DB::beginTransaction();
                People::destroy($people->id);
                DB::commit();
                return redirect()->back()
                ->with('success', 'Deletado com sucesso');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->back()
                ->with('error', 'Falha ao deletar');
            }
            return view('peoples.edit', compact('people'));
        return redirect()->back();
    }
}
