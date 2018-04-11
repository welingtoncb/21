<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    protected $fillable = ['codigo','titulo','tipo','endereco','numero','complemento','bairro','cidade','uf','cep','valor_venda','valor_locacao','valor_temporada','metro_quadrado','quantidade_dormitorio','quantidade_suite','quantidade_sala','quantidade_garagem','imagem','descricao'];
    protected $guarded = ['id','created_at', 'update_at'];
    protected $table = 'imovel';

    public $rules = [
        'codigo' => 'required',
        'titulo' => 'required|min:3|max:200',
        'tipo' => 'required',
        'endereco' => 'required|min:3|max:200',
        'numero' => 'required',
        'bairro' => 'required|min:3|max:100',
        'cidade' => 'required|min:3|max:100',
        'uf' => 'required|min:1|max:2',
        'cep' => 'required|min:8',
        'descricao' => 'min:3|max:200'
    ];
}
