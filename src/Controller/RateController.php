<?php

declare(strict_types=1);

namespace Inter\Controller;

use Inter\Classes\Api\Api;
use Inter\Entity\Rate;
use Inter\Repository\RateRepository;
use Inter\Type\Rate\Code;
use Inter\Type\Rate\Currency;
use Inter\Type\Rate\Mid;

class RateController
{
    public function __construct(
        private Api $api,
        private RateRepository $rateRepository,
    ) {
    }


    public function refresh()
    {
        $ratesResponse = $this->api->getExchangeRates();

        if (! $ratesResponse->getSuccess()) {
            echo 'Failed. ' . $ratesResponse->getMessage();
            die;
        }

        /** @var array<int, Rate> $rates */
        $rates = [];
        foreach ($ratesResponse->getData() as $data) {
            $rate = new Rate();
            $rate->setCurrency(new Currency($data['currency'] ?? null));
            $rate->setCode(new Code($data['code'] ?? null));
            $rate->setMid(new Mid($data['mid'] ?? null));

            $rates[] = $rate;
        }

        $this->rateRepository->replaceMany($rates);

        header("Location: /");
        die();
    }
}
