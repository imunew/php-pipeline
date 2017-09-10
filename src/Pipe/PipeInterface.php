<?php
namespace Imunew\Pipeline\Pipe;

use Imunew\Pipeline\Context\ContextInterface;

/**
 * Interface CallableInterface
 * @package Imunew\Pipeline
 */
interface PipeInterface
{
    /**
     * @param ContextInterface $context
     * @return ContextInterface
     */
    public function __invoke($context);
}
