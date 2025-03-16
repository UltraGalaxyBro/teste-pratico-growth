<?php

namespace App\Models;

use App\Attributes\Validation;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rules\Enum;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'descricao', 'preco', 'status'];

    protected $casts = [
        'status' => Status::class,
        'preco' => 'decimal:2'
    ];

    #[Validation(['required', 'string', 'max:255'])]
    protected string $nome;

    #[Validation(['required', 'string'])]
    protected string $descricao;

    #[Validation(['required', 'numeric', 'min:0'])]
    protected float $preco;

    #[Validation(['required', new Enum(Status::class)])]
    protected Status $status;

    public static function getValidationRules(): array
    {
        $rules = [];
        $reflection = new \ReflectionClass(self::class);
        
        foreach ($reflection->getProperties() as $property) {
            $attributes = $property->getAttributes(Validation::class);
            
            foreach ($attributes as $attribute) {
                $rules[$property->getName()] = $attribute->getArguments()[0];
            }
        }
        
        return $rules;
    }
}