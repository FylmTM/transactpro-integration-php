<?php

namespace tests\TransactPRO\Gate\Builders;

use TransactPRO\Gate\Builders\InitRecurrentP2PDataBuilder;

class InitRecurrentP2PDataBuilderTest extends BuilderTestCase
{
    public function setUp()
    {
        $this->builderClass     = InitRecurrentP2PDataBuilder::class;
        $this->data             = array(
            'rs'                      => 'AAAA',
            'original_init_id'        => '13hpf5rp1e0ss72dypjnhalzn1wmrkfmsjtwzocg',
            'merchant_transaction_id' => microtime(true),
            'amount'                  => '100',
            'description'             => 'Test description',
        );
        $this->buildData        = $this->data;
    }

    public function getMandatoryFields()
    {
        return array(
            array('rs'),
            array('original_init_id'),
            array('merchant_transaction_id'),
            array('amount'),
        );
    }

    public function getNonMandatoryFields()
    {
        return array(
            array('description'),
        );
    }
}