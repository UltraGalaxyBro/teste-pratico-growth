<?php

namespace App\Models;

use App\Attributes\Validation;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\Enum;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'status'
    ];

    protected $casts = [
        'status' => Status::class,
        'preco' => 'decimal:2'
    ];

    #[Validation(['required', 'string', 'max:255'])]
    public $nome;

    #[Validation(['required', 'string'])]
    public $descricao;

    #[Validation(['required', 'numeric', 'min:0'])]
    public $preco;

    #[Validation(['required'])]
    public $status;
    
    public static function getValidationRules(): array
    {
        $rules = [];
        $reflection = new \ReflectionClass(self::class);
        
        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Validation::class);
            
            if (!empty($attributes)) {
                $attribute = $attributes[0]->newInstance();
                $rules[$property->getName()] = $attribute->rules;
                
                if ($property->getName() === 'status') {
                    $rules[$property->getName()][] = new Enum(Status::class);
                }
            }
        }
        
        return $rules;
    }
}