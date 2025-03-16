<?php

namespace App\DTOs;

use App\Enums\Status;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Enum;

class ProductDTO
{
    public function __construct(
        public readonly string $nome,
        public readonly string $descricao,
        public readonly float $preco,
        public readonly Status $status,
    ) {}

    public static function fromArray(array $data): self
    {
        // Validando os dados
        $validator = Validator::make($data, [
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string'],
            'preco' => ['required', 'numeric', 'min:0'],
            'status' => ['required', new Enum(Status::class)],
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return new self(
            nome: $data['nome'],
            descricao: $data['descricao'],
            preco: (float) $data['preco'],
            status: is_string($data['status']) ? Status::from($data['status']) : $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'status' => $this->status->value,
        ];
    }
}