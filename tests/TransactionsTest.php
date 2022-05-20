<?php

use PHPUnit\Framework\TestCase;
use tonc\components\transactions\TransactionRepository;
use tonc\interfaces\transactions\ITransaction;
use tonc\interfaces\transactions\ITransactionInMessage;
use tonc\interfaces\transactions\ITransactionMessageData;

class TransactionsTest extends TestCase
{
    public function testTransactionsRepositoryOne()
    {
        sleep(2);// toncenter rps limit 1
        $repo = new TransactionRepository();

        $transaction = $repo->one(
            'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
            [
                ITransaction::FIELD__IN_MESSAGE => [
                    ITransactionInMessage::FIELD__SOURCE => ['=', 'EQCtiv7PrMJImWiF2L5oJCgPnzp-VML2CAt5cbn1VsKAxLiE'],
                    ITransactionInMessage::FIELD__VALUE => ['>', '9600000000'], //9.6 toncoins
                    ITransactionInMessage::FIELD__MESSAGE_DATA => [
                        ITransactionMessageData::FIELD__TEXT => ['like', 'ZWZ']
                    ]
                ],
                ITransaction::FIELD__FEE => ['in', [1192940]]
            ]
        );
        $this->assertEquals(
            $transaction->getId()->getHash(), 
            'AG6xTixfWeKM9SasFqNRnLL8lFnAWSkIO64tDZUZYJI=', 
            'Incorrect transaction: '.PHP_EOL.print_r($transaction, true)
        );
    }

    public function testTransactionOutMessages()
    {
        sleep(2);// toncenter rps limit 1
        $repo = new TransactionRepository();

        $transaction = $repo->one(
            'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
            [
                ITransaction::FIELD__OUT_MESSAGES => [
                    ITransactionInMessage::FIELD__DESTINATION => ['=', 'EQBlU_tKISgpepeMFT9t3xTDeiVmo25dW_4vUOl6jId_BNIj'],
                    ITransactionInMessage::FIELD__VALUE => ['>', '890800240'], //0.8 toncoins
                    ITransactionInMessage::FIELD__MESSAGE_DATA => [
                        'body' => ['like', 'ysuc']
                    ]
                ],
                ITransaction::FIELD__FEE => ['in', [13506001]]
            ]
        );
        $this->assertEquals(
            $transaction->getId()->getHash(), 
            'cKWsLVW2BBmRT1RY2HNwrbIhmMDyFPpuZoBZ3mpIopo=', 
            'Incorrect transaction: '.PHP_EOL.print_r($transaction, true)
        );
    }
}
