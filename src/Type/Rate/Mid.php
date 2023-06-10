<?php

declare(strict_types=1);

namespace Inter\Type\Rate;

use InvalidArgumentException;

class Mid
{
    private float $mid;

    public function __construct(
        float $mid
    ) {
        if ($mid <= 0) {
            throw new InvalidArgumentException('Invalid Rate Mid. Rate Mid cannot be less than 0.');
        }

        $this->mid = $mid;
    }

    public function getMid()
    {
        return $this->mid;
    }

    public function __toString()
    {
        return (string)$this->getMid();
    }
}
