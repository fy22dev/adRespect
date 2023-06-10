<?php

declare(strict_types=1);

namespace Inter\Entity;

use Inter\Type\Rate\Code;
use Inter\Type\Rate\Currency;
use Inter\Type\Rate\Mid;

class Rate
{
    private ?int $id;
    private Currency $currency;
    private Code $code;
    private Mid $mid;

    public function __construct(?int $id = null)
    {
        if ($id) {
            $this->id = $id;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMid()
    {
        return $this->mid;
    }

    public function setMid(Mid $mid)
    {
        $this->mid = $mid;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(Code $code)
    {
        $this->code = $code;

        return $this;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;

        return $this;
    }
}
