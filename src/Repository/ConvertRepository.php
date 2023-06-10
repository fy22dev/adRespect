<?php

declare(strict_types=1);

namespace Inter\Repository;

use Core\Db;
use Core\Repository;
use Inter\Entity\Convert;
use Inter\Type\Amount;

class ConvertRepository extends Repository
{
    protected const TABLE = 'convert';
    protected const ORDER_BY = 'id';
    protected const ORDER = 'DESC';

    public function __construct(
        protected Db $db,
        private RateRepository $rateRepository,
    ) {
        parent::__construct($this->db);
    }

    public function insert(Convert $convert): bool
    {
        $stmt = $this->db->prepare(sprintf(
            'INSERT INTO `%s`
            (`from`, `to`, `amount`)
            VALUES
            (:from, :to, :amount)',
            self::TABLE
        ));

        return $stmt->execute([
            'from' => $convert->getFrom()->getId(),
            'to' => $convert->getTo()->getId(),
            'amount' => $convert->getAmount()->getAmount(),
        ]);
    }

    protected function arrayToObject(array $row): ?Convert
    {
        $convert = new Convert((int)$row['id']);
        $convert
            ->setFrom($this->rateRepository->find((int)$row['from']))
            ->setTo($this->rateRepository->find((int)$row['to']))
            ->setAmount(new Amount((float)$row['amount']))
        ;

        return $convert;
    }
}
