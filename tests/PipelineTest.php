<?php
namespace Imunew\Pipeline\Test;

require_once __DIR__. '/Pipe/IncrementNumberPipe.php';

use Imunew\Pipeline\Context\Context;
use Imunew\Pipeline\Context\ContextInterface;
use Imunew\Pipeline\Pipe\Pipes;
use Imunew\Pipeline\Pipeline;
use Imunew\Pipeline\Test\Pipe\IncrementNumberPipe;
use PHPUnit\Framework\TestCase;

/**
 * Class PipelineTest
 * @package Imunew\Pipeline\Test
 */
class PipelineTest extends TestCase
{
    /**
     * @test
     */
    public function processSuccessWithIncrementNumberPipes()
    {
        $pipes = new Pipes();
        $expectedNumber = $initialNumber = 0;
        foreach (range(1, 10) as $number)
        {
            ++$expectedNumber;
            $pipes = $pipes->add($number, new IncrementNumberPipe());
        }

        $pipeline = new Pipeline($pipes);
        $context = $pipeline->process(new Context(['number' => $initialNumber]));

        $this->assertSame($expectedNumber, $context->getData('number'));
    }

    /**
     * @test
     */
    public function processSuccessWithMessagePipes()
    {
        $messages = ['This', ' is', ' the', ' open-source', ' library.'];
        $pipes = $this->createPipesWithMessages($messages);

        $pipeline = new Pipeline($pipes);
        $context = $pipeline->process(new Context());

        $this->assertSame(implode('', $messages), $context->getData('message'));
    }

    /**
     * @test
     */
    public function processSuccessWithExtraMessagePipes()
    {
        $messages = ['This', ' is', ' the', ' open-source', ' library.'];
        $pipes = $this->createPipesWithMessages($messages);
        $pipes = $pipes->add(35, function ($context) {
            /** @var ContextInterface $context */
            $data = $context->getData('message', '');
            return $context->setData('message', $data. ' best');
        });

        $pipeline = new Pipeline($pipes);
        $context = $pipeline->process(new Context());

        $this->assertSame('This is the best open-source library.', $context->getData('message'));
    }

    /**
     * @test
     * @expectedException \RuntimeException
     */
    public function processFailedByNotReturnContext()
    {
        $pipes = (new Pipes())->add(1, function ($context) { return null; });

        $pipeline = new Pipeline($pipes);
        $pipeline->process(new Context());
    }

    private function createPipesWithMessages(array $messages)
    {
        $pipes = new Pipes();

        foreach ($messages as $index => $message) {
            $pipes = $pipes->add(($index + 1) * 10, function ($context) use ($message) {
                /** @var ContextInterface $context */
                $data = $context->getData('message', '');
                return $context->setData('message', $data. $message);
            });
        }

        return $pipes;
    }

}