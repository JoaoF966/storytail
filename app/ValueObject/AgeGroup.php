<?php

namespace App\ValueObject;

class AgeGroup implements \Stringable
{
    private int $min;
    private int $max;

    private function __construct(string $value)
    {
        $values = explode('-', $value);

        if (count($values) !== 2) {
            throw new \InvalidArgumentException('Age group value must be in the format "min-max"');
        }

        if (!is_numeric($values[0]) || !is_numeric($values[1])) {
            throw new \InvalidArgumentException('Age group value must be numeric');
        }

        if ($values[0] >= $values[1]) {
            throw new \InvalidArgumentException('Minimum age must be less than maximum age');
        }

        $this->min = (int)$values[0];
        $this->max = (int)$values[1];
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function __toString(): string
    {
        return "{$this->min}-{$this->max}";
    }
}
