<?php

use PHPUnit\Framework\TestCase;
use tonc\components\transactions\TransactionRepository;
use tonc\components\transactions\Transaction;
use tonc\interfaces\transactions\ITransaction;
use tonc\interfaces\transactions\ITransactionId;
use tonc\interfaces\transactions\ITransactionInMessage;
use tonc\interfaces\transactions\ITransactionOutMessage;
use tonc\interfaces\transactions\ITransactionMessageData;

class TransactionsTest extends TestCase
{
    public function testTransactionProperties()
    {
        $data = include __DIR__ . '/resources/transaction.php';
        $t = new Transaction($data);

        $this->assertEquals($t->getType(), 'raw.transaction');
        $this->assertEquals($t->getUtime(), 1650434939);
        $this->assertTrue(strlen($t->getData()) > 0);

        $this->assertTrue($t->getId() instanceof ITransactionId);
        $this->assertEquals($t->getId()->getType(), 'internal.transactionId');
        $this->assertEquals($t->getId()->getLt(), 27251004000001);
        $this->assertEquals($t->getId()->getHash(), 'cKWsLVW2BBmRT1RY2HNwrbIhmMDyFPpuZoBZ3mpIopo=');

        $this->assertEquals($t->getFee(), 13506001);
        $this->assertEquals($t->getStorageFee(), 1);
        $this->assertEquals($t->getOtherFee(), 13506000);

        $this->assertTrue($t->getInMessage() instanceof ITransactionInMessage);
        $this->assertEquals($t->getInMessage()->getType(), 'raw.message');
        $this->assertEquals($t->getInMessage()->getSource(), 's');
        $this->assertEquals($t->getInMessage()->getDestination(), 'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr');
        $this->assertEquals($t->getInMessage()->getValue(), 1);
        $this->assertEquals($t->getInMessage()->getForwardFee(), 1);
        $this->assertEquals($t->getInMessage()->getIHRFee(), 1);
        $this->assertEquals($t->getInMessage()->getCreatedLT(), 1);
        $this->assertEquals($t->getInMessage()->getBodyHash(), 'a4Xh+VWw5/jyA9xKt9ewYUxhaymvNqJpmES3eevbNPk=');

        $this->assertTrue($t->getInMessage()->getMessageData() instanceof ITransactionMessageData);
        $this->assertEquals($t->getInMessage()->getMessageData()->getType(), 'msg.dataRaw');
        $this->assertEquals($t->getInMessage()->getMessageData()->getText(), 'C7/C2s');
        $this->assertEquals($t->getInMessage()->getMessageData()->getBody(), 'AAAAAAAC7/C2s');
        $this->assertEquals($t->getInMessage()->getMessageData()->getInitState(), 'ook');

        $this->assertEquals($t->getInMessage()->getMessage(), "0kiXeSwSxTMnNPd3oF188K769suemhyf34DRRWPGocbteBTFGqI8Lp5ZelUcU2fMNWDxOG4rGGAT\ngMoMOvK1CCmpoxf/////AAAAAAAD\n");

        $this->assertTrue(is_array($t->getOutMessages()));

        $outMsgs = $t->getOutMessages();
        $outMsg = array_shift($outMsgs);

        $this->assertTrue($outMsg instanceof ITransactionOutMessage);
    }

    public function testTransactionsRepositoryOne()
    {
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

        $transaction = $repo->one(
            'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
            [
                ITransaction::FIELD__IN_MESSAGE => [
                    ITransactionInMessage::FIELD__SOURCE => ['=', 'not existing address']
                ]
            ]
        );

        $this->assertNull($transaction);
    }

    public function testTransactionsRepositoryAll()
    {
        $repo = new TransactionRepository();

        $transactions = $repo->all(
            'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
            [
                ITransaction::FIELD__IN_MESSAGE => [
                    ITransactionInMessage::FIELD__SOURCE => ['=', 'EQCtiv7PrMJImWiF2L5oJCgPnzp-VML2CAt5cbn1VsKAxLiE'],
                ]
            ]
        );
        $this->assertTrue(count($transactions) > 1);
    }

    public function testTransactionOutMessages()
    {
        $repo = new TransactionRepository();

        $transaction = $repo->one(
            'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
            [
                ITransaction::FIELD__OUT_MESSAGES => [
                    ITransactionOutMessage::FIELD__DESTINATION => ['=', 'EQBlU_tKISgpepeMFT9t3xTDeiVmo25dW_4vUOl6jId_BNIj'],
                    ITransactionOutMessage::FIELD__VALUE => ['>', '890800240'], //0.8 toncoins
                    ITransactionOutMessage::FIELD__MESSAGE_DATA => [
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
