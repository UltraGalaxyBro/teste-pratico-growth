<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\DTOs\ProductDTO;
use App\Enums\Status;
use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $dto = ProductDTO::fromArray([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'status' => $data['status'],
        ]);
        
        return $dto->toArray();
    }
}