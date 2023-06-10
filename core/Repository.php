<?php
declare(strict_types=1);

namespace Core;

abstract class Repository
{
    protected const TABLE = null;
    protected const ORDER_BY = null;
    protected const ORDER = null;

    public function __construct(
        protected Db $db,
    ) {}

    abstract protected function arrayToObject(array $row): ?object;

    public function find(?int $id): ?object
    {
        if (empty($id)) {
            return null;
        }

        $stmt = $this->db->prepare(sprintf('SELECT * FROM `%s` WHERE `id` = %d', static::TABLE, $id));
        $stmt->execute();

        $row = $stmt->fetch();
        if (empty($row)) {
            return null;
        }

        $rate = $this->arrayToObject($row);

        return $rate;
    }

    public function findAll(): array
    {
        $all = [];

        $stmt = $this->db->prepare(
            sprintf(
                'SELECT * FROM `%s` ORDER BY %s %s', static::TABLE, static::ORDER_BY, static::ORDER
            )
        );
        $stmt->execute();

        foreach ($stmt as $row) {
            $all[] = $this->arrayToObject($row);
        }

        return $all;
    }
}
