<?php

declare(strict_types=1);

namespace app\services;

class TransactionManager
{
    public function wrap(callable $function): void
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $function();
            $transaction->commit();
        } catch (\Exception $e) {
            var_dump($e->getMessage()); die;
            $transaction->rollBack();
            throw new \DomainException($e->getMessage(), $e->getCode());
        }
    }
}