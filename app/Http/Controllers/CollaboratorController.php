<?php // app\Http\Controllers\CollaboratorController.php

namespace App\Http\Controllers;

use App\Models\Sector; // Importa o modelo de setores
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Inertia\Inertia; // Importa o Inertia para renderizar as páginas
use Illuminate\Support\Facades\DB; // Importa o DB para usar o DB::transaction


class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Método para renderizar a página de colaboradores
    {
        $collaborators = Collaborator::select('collaborators.id', 'collaborators.name', 'phone', 'email',
        'sector_id', 'sectors.name as sector') // Seleciona os campos da tabela de colaboradores
        ->join('sectors', 'sectors.id', '=', 'collaborators.sector_id') // Faz o join com a tabela de setores
        ->paginate(10); // Pagina os resultados

        $sectors = Sector::all(); // Busca todos os setores
        return Inertia::render('Collaborators/Index', [ // Renderiza a página de colaboradores
            'collaborators' => $collaborators, // Passa os colaboradores para a página
            'sectors' => $sectors // Passa os setores para a página
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ // Validação dos campos
            'name' => 'required|max:160',
            'email' => 'required|max:90',
            'phone' => 'required|max:25',
            'sector_id' => 'required|numeric'
        ]);

        $collaborator = new Collaborator($request->input()); // Cria um novo colaborador
        $collaborator->save(); // Salva o colaborador
        return redirect('collaborators'); // Redireciona para a página de colaboradores

    }

    /**
     * Display the specified resource.
     */
    /* public function show(Collaborator $collaborator)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
   /*  public function edit(Collaborator $collaborator)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collaborator $collaborator)
    {
        $request->validate([ // Validação dos campos
            'name' => 'required|max:160',
            'email' => 'required|max:90',
            'phone' => 'required|max:25',
            'sector_id' => 'required|numeric'
        ]);
        $collaborator->update($request->input()); // Atualiza o colaborador
        return redirect('collaborators'); // Redireciona para a página de colaboradores
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete(); // Deleta o colaborador
        return redirect('collaborators'); // Redireciona para a página de colaboradores

    }

    public function CollaboratorBySector()
    {
        $data = Collaborator::select(DB::raw('count(collaborators.id) as count, sectors.name'))
            ->join('sectors', 'sectors.id', '=', 'collaborators.sector_id')
            ->groupBy('sectors.name')
            ->get();

        return Inertia::render('Collaborators/Graphic', ['data' => $data]);
    }

    public function reports (){

        $collaborators = Collaborator::select('collaborators.id', 'collaborators.name', 'email','phone',
        'sector_id', 'sectors.name as sector') // Seleciona os campos da tabela de colaboradores
        ->join('sectors', 'sectors.id', '=', 'collaborators.sector_id') // Faz o join com a tabela de setores
        ->get(); // Pagina os resultados

        $sectors = Sector::all(); // Busca todos os setores

        return Inertia::render('Collaborators/Reports', [ // Renderiza a página de colaboradores
            'collaborators' => $collaborators, // Passa os colaboradores para a página
            'sectors' => $sectors // Passa os setores para a página
        ]);

    }

}
