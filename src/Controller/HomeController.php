<?php

declare(strict_types=1);

namespace Inter\Controller;

use Inter\Repository\RateRepository;

class HomeController
{
    public function __construct(
        private RateRepository $rateRepository,
    ) {
    }

    public function list()
    {
        $allRates = $this->rateRepository->findAll();

        require_once(__DIR__ . '/../../templates/home.php');
    }
}
