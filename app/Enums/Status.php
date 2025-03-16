<?php

namespace App\Enums;

enum Status: string
{
    case ATIVO = 'ativo';
    case INATIVO = 'inativo';

    public function getLabel(): string
    {
        return match($this) {
            self::ATIVO => 'Ativo',
            self::INATIVO => 'Inativo',
        };
    }
}