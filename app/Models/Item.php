<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Cria o model Item
class Item extends Model
{   
    //Model Item mapeia a tabela produtos no banco de dados
    protected $table = 'produtos'; //O nome da tabela no banco de dados é produtos - Faz o link manualmente
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    //Relacionamento entre Item e ItemDetalhe
    public function itemDetalhe(){
        //Determina que o relacionamento é (um para muitos) e que a fk é produto_id e a pk local é id
        return $this->hasOne(ItemDetalhe::class, 'produto_id', 'id');
    }
}
