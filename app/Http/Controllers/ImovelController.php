<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Imovel;

class ImovelController extends Controller
{
    private $imovel;
    
    public function __construct(Imovel $Imovel) {
        $this->imovel = $Imovel;
    }
    
    public function create()
    {
        $title = "Cadastrar Imóvel";
        $tipos = ['Apartamento','Casa'];
        
        return view('create', compact('title','tipos'));
    }

    public function store(Request $request)
    {
        $aDataForm = $request->except(['_token']);
        
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $name = basename($request->imagem).time();
            $ext = $request->imagem->extension();
            
            $nameFile = "{$name}.{$ext}";
            
            $aDataForm['imagem'] = $nameFile;
            
            $upload = $request->imagem->storeAS('imoveis',$nameFile);
            
            if(!$upload){
                return redirect()->back()->with('error','Falha ao fazer o upload!');
            }
        }
        
        $this->validate($request, $this->imovel->rules);
            
        $insert = $this->imovel->create($aDataForm);
        
        if($insert){
            return redirect()->route('imovel')->with('status','Cadastrado Com Sucesso!');
        }
        else{
            //return redirect()->back();
            return redirect()->route('imovel')->with('errors','Erro ao Cadastrar!');
        }
    }
    
    public function listing(Imovel $imovel)
    {
        $imoveis = $imovel::all();
        
        //dd($imoveis);
        return view('list', compact('imoveis'));
    }
    
    public function edit($id)
    {
        $imovel = $this->imovel->find($id);
        
        $title = "Editar Imóvel: {$imovel->codigo}";
        $tipos = ['Apartamento','Casa'];
        
        return view('create', compact('title','tipos','imovel'));
    }
    
    public function update(Request $request, $id)
    {
        $aDataForm = $request->all();
        $imovel = $this->imovel->find($id);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $name = basename($request->imagem).time();
            $ext = $request->imagem->extension();
            
            $nameFile = "{$name}.{$ext}";
            
            $aDataForm['imagem'] = $nameFile;
            
            $upload = $request->imagem->storeAS('imoveis',$nameFile);
            
            if(!$upload){
                return redirect()->back()->with('error','Falha ao fazer o upload!');
            }
        }
       
        $update = $imovel->update($aDataForm);
        
        $this->validate($request, $this->imovel->rules);
        
        if($update){
            return redirect()->route('imovel')->with('status','Alterado Com Sucesso!');
        }
        else{
            return redirect()->route('imovel', $id)->with('errors','Erro ao alterar');
        }
    }

    public function delete($id)
    {
        $delete = $this->imovel->destroy($id);
        
        if($delete){
            return redirect()->route('imovel')->with('status','Deletado Com Sucesso!');
        }
        else{
            return redirect()->route('imovel', $id)->with('errors','Erro ao deletar');
        }
    }    
}
