<?php

namespace App\Enums;

enum Status: string
{
    case ATIVO = 'Ativo';
    case INATIVO = 'Inativo';

    public function getLabel(): string
    {
        return match($this) {
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
        };
    }
}