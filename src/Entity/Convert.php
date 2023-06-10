<?php

declare(strict_types=1);

namespace Inter\Entity;

use Inter\Type\Amount;

class Convert
{
    private const MAX_AMOUNT = 99999999.99;

    private ?int $id;
    private ?Rate $from;
    private ?Rate $to;
    private ?Amount $amount;

    public function __construct(?int $id = null)
    {
        if ($id) {
            $this->id = $id;
        }
    }

    public function isValid(): array
    {
        $errors = [];

        if ($this->getAmount()->getAmount() <= 0 || $this->getAmount()->getAmount() > self::MAX_AMOUNT) {
            $errors[] = 'Nieprawidłowa kwota';
        }
        if (empty($this->getFrom())) {
            $errors[] = 'Nie można odczywać waluty źródłowej';
        }
        if (empty($this->getTo())) {
            $errors[] = 'Nie można odczywać waluty docelowej';
        }

        return $errors;
    }

    public function convert(float $input)
    {
        $this->setAmount(new Amount(
            round(
                $input * (float)$this->getFrom()?->getMid()->getMid() / (float)$this->getTo()?->getMid()->getMid(),
                2
            )
        ));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFrom(): ?Rate
    {
        return $this->from;
    }

    public function setFrom(?Rate $from = null): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTo(): ?Rate
    {
        return $this->to;
    }

    public function setTo(?Rate $to = null): self
    {
        $this->to = $to;

        return $this;
    }

    public function getAmount(): ?Amount
    {
        return $this->amount;
    }

    public function setAmount(?Amount $amount = null): self
    {
        $this->amount = $amount;

        return $this;
    }
}
