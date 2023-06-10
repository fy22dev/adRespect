<?php

declare(strict_types=1);

namespace Inter\Repository;

use Core\Repository;
use Inter\Entity\Rate;
use Inter\Type\Rate\Code;
use Inter\Type\Rate\Currency;
use Inter\Type\Rate\Mid;

class RateRepository extends Repository
{
    /** @var string */
    protected const TABLE = 'rate';
    protected const ORDER_BY = 'currency';
    protected const ORDER = 'ASC';

    public function replaceMany(array $rates): bool
    {
        $values = '';
        $bindings = [];

        foreach ($rates as $rate) {
            $uniq = $rate->getCode()->getCode();

            $values .= '(:currency_' . $uniq . ', :mid_' . $uniq . ', :code_' . $uniq . '),';
            $bindings['currency_' . $uniq] = $rate->getCurrency()->getCurrency();
            $bindings['mid_' . $uniq] = $rate->getMid()->getMid();
            $bindings['code_' . $uniq] = $rate->getCode()->getCode();
        }

        $stmt = $this->db->prepare(sprintf(
            'INSERT INTO %s
            (currency, mid, code)
            VALUES
            %s
            ON DUPLICATE KEY UPDATE mid = VALUES(mid)',
            self::TABLE,
            rtrim($values, ',')
        ));

        return $stmt->execute($bindings);
    }

    protected function arrayToObject(array $row): ?Rate
    {
        $rate = new Rate((int)$row['id']);
        $rate->setCode(new Code($row['code']))
            ->setCurrency(new Currency($row['currency']))
            ->setMid(new Mid((float)$row['mid']))
        ;

        return $rate;
    }
}
