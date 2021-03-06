<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Cria o model Item
class Item extends Model
{   
    //Model Item mapeia a tabela produtos no banco de dados
    protected $table = 'produtos'; //O nome da tabela no banco de dados é produtos - Faz o link manualmente
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    //Relacionamento entre Item e ItemDetalhe
    public function itemDetalhe(){
        //Determina que o relacionamento é (um para muitos) e que a fk é produto_id e a pk local é id
        return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
    }

    //Relacionamento entre Item e Fornecedor
    public function fornecedor(){
        //Determina que um Item pertence a um Fornecedor
        return $this->belongsTo(Fornecedor::class);
    }

    public function pedidos() {
        return $this->belongsToMany('App\models\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');

        /*
            3 - Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento
            4 - Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
    }
}
