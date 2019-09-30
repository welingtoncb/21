<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ImovelImportar extends Model
{
    protected $fillable = ['codigo','titulo','tipo','numero','complemento','bairro','cidade','uf','cep','valor_venda','valor_locacao','valor_temporada','metro_quadrado','quantidade_dormitorio','quantidade_suite','quantidade_sala','quantidade_garagem','imagem','descricao'];
    protected $guarded = ['id','created_at', 'update_at'];
    protected $table = 'imoveis_importar';
}
