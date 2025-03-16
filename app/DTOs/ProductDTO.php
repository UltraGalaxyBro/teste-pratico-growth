<?php

namespace App\DTOs;

use App\Enums\Status;

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
            'status' => $this->status,
        ];
    }
}
