<?php

namespace App\Controller\Backend;

use Symfony\Component\Form\DataTransformerInterface;

class DelimitedStringToArrayTransformer implements DataTransformerInterface
{
    private $delimiter;

    public function __construct(string $delimiter)
    {
        $this->delimiter = $delimiter;
    }

    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
        return implode($this->delimiter, $value);
    }
    
    public function reverseTransform($value)
    {
        if (!$value) {
            return [];
        }
        return explode($this->delimiter, $value);
    }
}