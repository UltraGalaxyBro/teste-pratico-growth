<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\DTOs\ProductDTO;
use App\Filament\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            $dto = ProductDTO::fromArray($data);
            //Só para o Filament aproveitar
            return $dto->toArray();
        } catch (\InvalidArgumentException $e) {
            throw ValidationException::withMessages([
                'nome' => $e->getMessage(),

            ]);
        }
    }
}