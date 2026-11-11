<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view("produto.index", [
            "produtos" => Produto::all(),
            "titulo"    => "almoxarifado de produtos"

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view("produto.create",[
            "titulo" => "Novo Cadastro de Produto"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            "codigo" => "required|unique",
            "nome"  => "required|min:3",
            "fabricante"          => "required|min:3", //permite a validação de cnpj unico no banco
            "estoque"         => "required|numeric | min:0",
            "preco"  => "required|numeric | min:0",


        ]);

        Produto::create($dados);
        return redirect()->route("produto.index")->with("sucesso", "produto cadastrado com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $produto = Produto::findOrFail($id);


          return view("produtos.show", [
            "produto"  => $produto,
            "titulo"    => "Ficha Técnica: {$produto["nome"]}"
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produto = Produto::findOrFail($id);

        return view("Produtos.edit", [
            "produto"  => $produto,
            "titulo"    => "editar produto: {$produto["nome"]}"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {$dados = $request->validate([
           "codigo" => "required|unique",
            "nome"  => "required|min:3",
            "fabricante"          => "required|min:3", 
            "estoque"         => "required|numeric | min:0",
            "preco"  => "required|numeric | min:0",

        ]);

        Produto::findOrFail($id)->update($dados);
        return redirect()->route("produtos.show", $id)->with("sucesso", "produto atualizado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Produto::findOrFail($id)->delete();
        return redirect()->route("produto.index")->with("sucesso", "produto Removido do Sistema");
    }
}
