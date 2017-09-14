<?php
namespace Imunew\Pipeline\Pipe;

use Iterator;

/**
 * Interface PipesInterface
 * @package Imunew\Pipeline\Pipe
 */
interface PipesInterface extends Iterator
{
    /**
     * @param int $order
     * @param callable $pipe
     * @return PipesInterface
     */
    public function add($order, callable $pipe);

}
