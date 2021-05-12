<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos()
    {
        //return $this->belongsToMany('App\Produto', 'pedidos_produtos');
        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')
        ->withPivot('id','created_at', 'updated_at');
        /*
        1 - modelo do rel NxN em relação ao Modelo sendo implementado
        2 - Tabela auxiliar que armazena os reg. relacionamento
        3 - A FK mapeada pelo model na tabela de relacionamento
        4 - A FK mapeada pelo model usado no relacionamento sendo implementado
        */
    }
}
