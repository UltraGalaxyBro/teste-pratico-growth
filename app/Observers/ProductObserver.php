<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Log::info('Produto criado: ' . $product->nome);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $changes = $product->getChanges();

        if (isset($changes['status'])) {
            Log::info('Status do produto alterado: ' . $product->nome . ' - Novo status: ' . $product->status->value);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Log::info('Produto excluído (soft delete): ' . $product->nome);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        Log::info('Produto restaurado: ' . $product->nome);
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        Log::info('Produto excluído permanentemente: ' . $product->nome);
    }
}
