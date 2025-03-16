<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Validation
{
    public function __construct(public array $rules) {}
}
