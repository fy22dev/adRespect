<?php

declare(strict_types=1);

namespace Inter\Type\Rate;

use InvalidArgumentException;

class Currency
{
    private string $currency;

    public function __construct(
        string $currency
    ) {
        if (mb_strlen($currency) < 1) {
            throw new InvalidArgumentException('Invalid Rate Currency. Rate Currency cannot be empty.');
        }

        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function __toString()
    {
        return htmlspecialchars(strip_tags($this->getCurrency()), ENT_QUOTES, 'UTF-8');
    }
}
