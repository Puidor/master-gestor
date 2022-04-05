<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    // use SoftDeletes; Não deleta o registro, apenas o seta como inativo
    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    public function produtos()
    {
        //Fornecedor tem muitos produtos (belongsToMany). FK em fornecedor: fornecedor_id, PK Local: id
        return $this->hasMany(Produto::class, 'fornecedor_id', 'id');
    }
}
