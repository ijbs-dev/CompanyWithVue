<?php // CompanyWithVue\app\Http\Controllers\SectorController.php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::all(); // Busca todos os setores
        return Inertia::render('Sectors/Index', [ // Renderiza a página de setores
            'sectors' => $sectors // Passa os setores para a página
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Sectors/Create'); // Renderiza a página de criação de setores
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:sectors|max:255']); // Validação do campo nome
        $sectors = new Sector($request->input()); // Cria um novo setor
        $sectors->save(); // Salva o setor
        return redirect('sectors'); // Redireciona para a página de setores

    }

    /**
     * Display the specified resource.
     */
    public function show(Sector $sector)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sector $sector)
    {
        return Inertia::render('Sectors/Edit', [ // Renderiza a página de edição de setores
            'sector' => $sector // Passa o setor para a página
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sector $sector)
    {
        $request->validate(['name' => 'required|max:255']); // Validação do campo nome do setor
        $sector->update($request->all()); // Atualiza o setor
        return redirect('sectors'); // Redireciona para a página de setores
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sector $sector)
    {
        $sector->delete(); // Deleta o setor
        return redirect('sectors'); // Redireciona para a página de setores
    }
}
