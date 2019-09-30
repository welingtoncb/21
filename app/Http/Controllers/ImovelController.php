<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Imovel;
use App\Http\Models\ImovelImportar;
use Illuminate\Support\Facades\Storage;
//use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\Input;

class ImovelController extends Controller {

    private $imovel;
    private $imovelImportar;
    private $totalPerPage = 2;
    
    public function __construct(Imovel $Imovel, ImovelImportar $imovelImportar) {
        $this->imovel = $Imovel;
        $this->imovelImportar = $imovelImportar;
    }
    
    public function create() 
    {
        $title = "Cadastrar Imóvel";
        $tipos = ['Apartamento','Casa'];
        
        return view('create', compact('title','tipos'));
    }

    public function store(Request $request, $source = null) 
    {
        $aDataForm = $request->except(['_token']);
       
        if($request->hasFile('imagem') && $request->file('imagem')->isValid() && $source == 'criacao') {
            $name = basename($request->imagem).time();
            $ext = $request->imagem->extension();
            
            $nameFile = "{$name}.{$ext}";
            
            $aDataForm['imagem'] = $nameFile;
            
            $upload = $request->imagem->storeAS('imoveis',$nameFile);
            
            if(!$upload){
                return redirect()->back()->with('error','Falha ao fazer o upload!');
            }
        }
        
        if($source == 'criacao') {
            $this->validate($request, $this->imovel->rules);
        }

        if ($aDataForm['tipo'] == 0) {
            $aDataForm['tipo'] = 'Apartamento';
        } else {
            $aDataForm['tipo'] = 'Casa';
        }

        $insert = $this->imovel->create($aDataForm);
        
        if($insert) {
            if($source == 'criacao') {
                return redirect()->route('imovel')->with('status','Cadastrado Com Sucesso!');
            } else {
                return redirect()->route('import')->with('status','Importado Com Sucesso!');
            }
        } else {
            if($source == 'criacao') {
                return redirect()->route('imovel')->with('errors','Erro ao Cadastrar!');
            } else {
                return redirect()->route('import')->with('errors','Erro ao Importar!');
            }
        }
    }
    
    public function listing(Imovel $imovel)
    {
        $imv = $imovel::where('id','>=',1);
        $imoveis = $imv->paginate($this->totalPerPage);
        
        return view('list', compact('imoveis'));
    }
    
    public function edit($id) 
    {
        $imovel = $this->imovel->find($id);

        $title = "Editar Imóvel: {$imovel->codigo}";
        $tipos = ['Apartamento','Casa'];

        if ($imovel->tipo == 'Apartamento') {
            $tipoSelecionado = 0;
        } else {
            $tipoSelecionado = 1;
        }

        // Verifica se a imagem é armazenada em arquivo ou vem de url por conta da importação.
        if(file_exists('storage/imoveis/'.$imovel->imagem)) {
            $imovel['storage'] = true;
        } else {
            $imovel['storage'] = false;
        }

        return view('create', compact('title','tipos','imovel','tipoSelecionado'));
    }
    
    public function update(Request $request, $id) 
    {
        $aDataForm = $request->all();
        $imovel = $this->imovel->find($id);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()) {

            // Antes de atualizar a imagem eu deleto a antiga em caso dela estaja armazenado local
            if(file_exists('storage/imoveis/'.$imovel->imagem)) {
                Storage::delete('imoveis/'.$imovel->imagem);
            }

            $name = basename($request->imagem).time();
            $ext = $request->imagem->extension();
            
            $nameFile = "{$name}.{$ext}";
            $aDataForm['imagem'] = $nameFile;
            
            $upload = $request->imagem->storeAS('imoveis',$nameFile);
            
            if(!$upload) {
                return redirect()->back()->with('error','Falha ao fazer o upload!');
            }
        }

        if ($aDataForm['tipo'] == 0) {
            $aDataForm['tipo'] = 'Apartamento';
        } else {
            $aDataForm['tipo'] = 'Casa';
        }

        $update = $imovel->update($aDataForm);
        
        $this->validate($request, $this->imovel->rules);
        
        if($update) {
            return redirect()->route('imovel')->with('status','Alterado Com Sucesso!');
        } else {
            return redirect()->route('imovel', $id)->with('errors','Erro ao alterar');
        }
    }

    public function delete($id) 
    {
        $imovel = $this->imovel->find($id);
        
        if(file_exists('storage/imoveis/'.$imovel->imagem)) {
            Storage::delete('imoveis/'.$imovel->imagem);
        }

        $delete = $imovel->destroy($id);

        if($delete) {
            return redirect()->route('listing')->with('status','Removido Com Sucesso!');
        } else {
            return redirect()->route('imovel', $id)->with('errors','Erro ao remover');
        }
    }
 
    public function view($id, Request $request) {
        $imovel = $this->imovel->find($id);
        
        // Verifica se a imagem é armazenada em arquivo ou vem de url por conta da importação.
        if(file_exists('storage/imoveis/'.$imovel->imagem)) {
            $imovel['storage'] = true;
        } else {
            $imovel['storage'] = false;
        }

        return view('view', compact('imovel'));
    }

    public function searchImmobile(Request $request, Imovel $imovel) {
        $dataForm = $request->except('_token');
        
        if($request->codigo != "") {
            $imoveis = $imovel->where('codigo',$request->codigo)->paginate($this->totalPerPage);
        } else {
            $imv = $imovel::where('id','>=',1);
            $imoveis = $imv->paginate($this->totalPerPage);
        }
        
        return view('list', compact('imoveis','dataForm'));
    }

    public function createImportXML(Request $request) 
    {
        // Pode ser URL externa em caso de web também
        $nameFile = "";
        if($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            $name = basename($request->arquivo).time();
            $ext = $request->arquivo->extension();
            
            $nameFile = "{$name}.{$ext}";            
            $upload = $request->arquivo->storeAS('importacao',$nameFile);
            
            if(!$upload){
                return redirect()->back()->with('error','Falha ao fazer o upload!');
            }
        }
        
        $errorsCustom = array(); $countErrorCustom = 0;
        if ($nameFile != "") {
            $url = 'storage/importacao/'.$nameFile;
            $imoveis = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);

            $imoveisImportar = new ImovelImportar();
            $imoveisView = array(); $i = 0;
            foreach($imoveis-> Imovel as $imovel) {
                try {
                    $imoveisImportar->create([
                        'codigo' => trim($imovel->CodigoImovel),
                        'titulo' => trim($imovel->SubTipoImovel),
                        'tipo' => trim($imovel->TipoImovel),
                        'cidade' => trim($imovel->Cidade),
                        'uf' => trim($imovel->UF),
                        'numero' => trim($imovel->Numero),
                        'complemento' => trim($imovel->Complemento),
                        'bairro' => trim($imovel->Bairro),
                        'cep' => trim($imovel->CEP),
                        'valor_venda' => trim(number_format(floatval($imovel->PrecoVenda),3,'','.')),
                        'valor_locacao' => trim($imovel->PrecoLocacao),
                        'valor_temporada' => trim($imovel->PrecoLocacaoTemporada),
                        'metro_quadrado' => trim($imovel->AreaTotal),
                        'quantidade_dormitorio' => trim($imovel->QtdDormitorios),
                        'quantidade_suite' => trim($imovel->QtdSuites),
                        'quantidade_sala' => trim($imovel->QtdSalas),
                        'quantidade_garagem' => trim($imovel->QtdVagas),
                        'imagem' => trim($imovel->Fotos[0]->Foto[0]->URLArquivo),
                        'descricao' => trim($imovel->Observacao),
                    ]);
                }catch (\Illuminate\Database\QueryException $ex) { 
                    $errorsCustom[$countErrorCustom] = 'Imóvel de código: '.$imovel->CodigoImovel.' já foi importado!';
                    $countErrorCustom++;
                }
            }
            
            // Caso queira fazer paginação personalizada aqui tem um exemplo
            /*
                $this->totalPerPage = 5;
                $page = Input::get('page', 1);
                if ($page > count($imoveisView) or $page < 1) { 
                    $page = 1; 
                }
                $offset = ($page * $this->totalPerPage) - $this->totalPerPage;
                $imvs = array_slice($imoveisView, $offset, $this->totalPerPage);
                $imoveisViews = new LengthAwarePaginator($imvs, count($imoveisView), $this->totalPerPage, $page);
                $imoveisViews->setPath($request->url());
            */
        }

        $imoveisImportados = Imovel::select('codigo')->get();

        $this->totalPerPage = 5;
        $imoveisViews = ImovelImportar::where('id','>=',1)->whereNotIn('codigo', $imoveisImportados)->paginate($this->totalPerPage);

        return view('importXML', compact('imoveisViews', 'errorsCustom'));
    }

}