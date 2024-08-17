<?php

namespace Domain\Shared\Transformers;

use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class UpperCaseTransformer implements Transformer
{
    /**
     * Transform output data
     *
     * @param \Spatie\LaravelData\Support\DataProperty $property
     * @param mixed $value
     * @param \Spatie\LaravelData\Support\Transformation\TransformationContext $context
     * @return string
     */
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {
        return strtoupper($value);
    }
}