<?php

declare(strict_types=1);

namespace Inter\Type;

use InvalidArgumentException;

class Amount
{
    private float $amount;

    public function __construct(
        float $amount
    ) {
        if ($amount < 0) {
            throw new InvalidArgumentException('Invalid Amount. Amount cannot be less than 0.');
        }

        $this->amount = $amount;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function __toString()
    {
        return number_format($this->getAmount(), 2, '.', '');
    }
}
