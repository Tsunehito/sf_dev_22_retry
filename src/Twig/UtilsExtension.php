<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class UtilsExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_array', [$this, 'isArray']),
            new TwigFunction('is_boolean', [$this, 'isBoolean']),
            new TwigFunction('is_float', [$this, 'isFloat']),
            new TwigFunction('is_int', [$this, 'isInt']),
            new TwigFunction('is_string', [$this, 'isString']),
            new TwigFunction('is_datetime', [$this, 'isDatetime']),
            new TwigFunction('is_date', [$this, 'isDate']),
            new TwigFunction('get_class', [$this, 'getClass']),
        ];
    }

    public function getClass($value): string
    {
        return get_class($value);
    }

    public function isDate($value): bool
    {       
        if ($value instanceof \Datetime) 
        {
            return ($value->format('H:i:s') == "00:00:00");
        }

        return false;
    }

    public function isDatetime($value): bool
    {
        if ($value instanceof \Datetime) 
        {
            return ($value->format('H:i:s') != "00:00:00");
        }

        return false;
    }

    public function isString($value): bool
    {
        return is_string($value);
    }

    public function isInt($value): bool
    {
        return is_int($value);
    }

    public function isFloat($value): bool
    {
        return is_float($value);
    }

    public function isBoolean($value): bool
    {
        return is_bool($value);
    }

    public function isArray($value): bool
    {
        return is_array($value);
    }
}
