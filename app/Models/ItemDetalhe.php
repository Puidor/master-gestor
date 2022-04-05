<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    protected $table = 'produto_detalhes'; //O nome da tabela no banco de dados é produtos - Faz o link manualmente
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function item(){
        //ItemDetalhe pertence a Item.
        return $this->belongsTo(Item::class, 'produto_id', 'id'); // Passa a FK local e a PK do pai
    }
}
