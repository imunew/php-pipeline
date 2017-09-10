<?php
namespace Imunew\Pipeline\Test\Context;

use Imunew\Pipeline\Context\Context;
use Imunew\Pipeline\Context\ContextInterface;
use Imunew\Pipeline\Context\Status;
use PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 * @package Imunew\Pipeline\Test\Context
 */
class ContextTest extends TestCase
{
    /**
     * @test
     * @dataProvider getTestStatus
     *
     * @param ContextInterface $context
     * @param $isInitialized
     * @param $isStarted
     * @param $isStopped
     */
    public function setStatus($context, $isInitialized, $isStarted, $isStopped)
    {
        $this->assertSame($isInitialized, $context->isInitialized());
        $this->assertSame($isStarted, $context->isStarted());
        $this->assertSame($isStopped, $context->isStopped());
    }

    public function getTestStatus()
    {
        $context = new Context();

        return [
            ['context' => $context->setStatus(Status::initialize()), 'isInitialized' => true, 'isStarted' => false, 'isStopped' => false],
            ['context' => $context->setStatus(Status::start()), 'isInitialized' => false, 'isStarted' => true, 'isStopped' => false],
            ['context' => $context->setStatus(Status::stop()), 'isInitialized' => false, 'isStarted' => false, 'isStopped' => true],
        ];
    }

}
