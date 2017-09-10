<?php
namespace Imunew\Pipeline\Test\Pipe;

use Imunew\Pipeline\Context\ContextInterface;
use Imunew\Pipeline\Pipe\PipeInterface;

/**
 * Class IncrementNumberPipe
 * @package Imunew\Pipeline\Test\Pipe
 */
class IncrementNumberPipe implements PipeInterface
{
    /**
     * @param ContextInterface $context
     * @return ContextInterface
     */
    public function __invoke($context)
    {
        $data = $context->getData('number', 1);
        return $context->setData('number', ++$data);
    }
}
