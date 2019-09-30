<?php

namespace App\Http\Services;
use App\Http\Models\Imovel;

class ImovelService
{
    public function totalImmobile() {
        $imv = Imovel::where('id','>=',0)->count();
        
        return $imv;
    }
}
