<?php
namespace Imunew\Pipeline\Test\Pipe;

use Imunew\Pipeline\Context\Context;
use Imunew\Pipeline\Context\ContextInterface;
use Imunew\Pipeline\Pipe\Pipes;
use Imunew\Pipeline\Pipeline;
use PHPUnit\Framework\TestCase;

/**
 * Class PipesTest
 * @package Imunew\Pipeline\Test\Pipe
 */
class PipesTest extends TestCase
{
    /**
     * @test
     */
    public function mergeNumberPipes()
    {
        $pipesA = (new Pipes())
            ->add(10, function ($context) {
                /** @var ContextInterface $context */
                $data = $context->getData('number', 0);
                return $context->setData('number', $data + 1);
            })
            ->add(20, function ($context) {
                /** @var ContextInterface $context */
                $data = $context->getData('number', 0);
                return $context->setData('number', $data * 10);
            })
        ;

        $pipesB = (new Pipes())
            ->add(15, function ($context) {
                /** @var ContextInterface $context */
                $data = $context->getData('number', 0);
                return $context->setData('number', $data + 2);
            })
        ;

        $pipesC = $pipesA->merge($pipesB);
        $pipeline = new Pipeline($pipesC);
        $context = $pipeline->process(new Context());

        $this->assertSame(30, $context->getData('number'));
    }

}
