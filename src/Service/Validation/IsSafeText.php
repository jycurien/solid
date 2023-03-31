<?php

namespace App\Service\Validation;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IsSafeText extends Constraint
{
    public string $message = 'This text does not comply with our moderation policy';
}