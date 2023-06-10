<?php

declare(strict_types=1);

namespace Inter\Controller;

use Inter\Entity\Convert;
use Inter\Repository\ConvertRepository;
use Inter\Repository\RateRepository;

class ConvertController
{
    public function __construct(
        private RateRepository $rateRepository,
        private ConvertRepository $convertRepository,
    ) {
    }

    public function convert()
    {
        $messages = [];
        $from = null;
        $to = null;
        $convert = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $inputAmount = (float)filter_input(
                    INPUT_POST,
                    'amount',
                    FILTER_SANITIZE_NUMBER_FLOAT,
                    FILTER_FLAG_ALLOW_FRACTION
                );
                $inputAmount = $inputAmount > 0 ? $inputAmount : 0;

                $from = $this->rateRepository->find(filter_input(INPUT_POST, 'from', FILTER_VALIDATE_INT));
                $to = $this->rateRepository->find(filter_input(INPUT_POST, 'to', FILTER_VALIDATE_INT));

                $convert = new Convert();
                $convert
                    ->setFrom($from)
                    ->setTo($to)
                ;
                $convert->convert($inputAmount);

                $messages['errors'] = $convert->isValid();
                if (empty($messages['errors'])) {
                    if ($this->convertRepository->insert($convert)) {
                        $messages['successes'][] = 'Zapisano nową konwersję.';
                    } else {
                        $messages['errors'][] = 'Nie udało się zapisac nowej konwersji.';
                    }
                }
            } catch (\Throwable $th) {
                $messages['errors'][] = $th->getMessage();
            }
        }

        $allRates = $this->rateRepository->findAll();
        $allConverts = $this->convertRepository->findAll(10);

        require_once(__DIR__ . '/../../templates/convert.php');
    }
}
