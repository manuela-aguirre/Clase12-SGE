<?php

namespace App\Models;

use App\Models\Concerns\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Auditable, SoftDeletes;

    protected string $auditLog = 'categorias';

    protected $table = 'categorias';

    protected $fillable = [
        'codigo',                       // <- agregar
        'nombre',
    ];

    // Relación: Categoria tiene muchos Productos
    public function products()
    {
        return $this->hasMany(Product::class, 'categoria_id');
    }
}

