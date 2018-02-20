<?php

namespace App\Validator\Contstraints;

use Symfony\Component\Validator\Constraint;

class ChocolateCake extends Constraint
{
    public $message = 'Only chocolate cakes are allowed.';
    public $pattern = '/[Cc]hocolate/';
}
