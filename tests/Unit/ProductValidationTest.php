<?php

namespace Tests\Unit;

use App\Enums\Status;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use Illuminate\Validation\ValidationException;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase;
    //TESTE DO REQUIRED
    public function test_product_requires_name()
    {
        $data = [
            'descricao' => 'Descrição do produto',
            'preco' => 10.99,
            'status' => Status::ATIVO->value
        ];

        $validator = Validator::make($data, Product::getValidationRules());
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('nome'));
    }
    //TESTE SITUACIONAL
    public function test_product_price_must_be_positive()
    {
        $data = [
            'nome' => 'Produto teste',
            'descricao' => 'Descrição do produto',
            'preco' => -10.99,
            'status' => Status::ATIVO->value
        ];

        $validator = Validator::make($data, Product::getValidationRules());
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('preco'));
    }

    //TESTE DO TIPO
    public function test_product_status_must_be_valid_enum_value()
    {
        $data = [
            'nome' => 'Produto teste',
            'descricao' => 'Descrição do produto',
            'preco' => 10.99,
            'status' => 'status_invalido'
        ];

        $validator = Validator::make($data, Product::getValidationRules());
        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('status'));
    }
    //TESTE DE TUDO CORRETO
    public function test_valid_product_passes_validation()
    {
        $data = [
            'nome' => 'Produto teste',
            'descricao' => 'Descrição do produto',
            'preco' => 10.99,
            'status' => Status::ATIVO->value
        ];

        $validator = Validator::make($data, Product::getValidationRules());
        $this->assertFalse($validator->fails());
    }
}
