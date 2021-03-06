<?php

namespace TransactPRO\Gate\Builders;

class CancelRequestDataBuilder extends Builder
{
    public function build()
    {
        return array(
            'init_transaction_id' => $this->getField('init_transaction_id'),
        );
    }

    protected function checkData()
    {
        $this->checkMandatoryField('init_transaction_id');
    }
}