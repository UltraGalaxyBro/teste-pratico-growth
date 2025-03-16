<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ViewLogs extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.view-logs';
    protected static ?string $navigationLabel = 'Visualizar Logs';

    public $logContent = '';

    public function mount(): void
    {
        $logFilePath = storage_path('logs/laravel.log');

        if (File::exists($logFilePath)) {
            $this->logContent = File::get($logFilePath);
        } else {
            $this->logContent = 'Arquivo de log não encontrado.';
        }
    }
}
