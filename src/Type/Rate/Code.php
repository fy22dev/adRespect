<?php

declare(strict_types=1);

namespace Inter\Type\Rate;

use InvalidArgumentException;

class Code
{
    private string $code;

    public function __construct(
        string $code
    ) {
        if (mb_strlen($code) !== 3) {
            throw new InvalidArgumentException('Invalid Rate Code. Rate Code must be exactly three characters long.');
        }

        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function __toString()
    {
        return htmlspecialchars(strip_tags($this->getCode()), ENT_QUOTES, 'UTF-8');
    }
}
