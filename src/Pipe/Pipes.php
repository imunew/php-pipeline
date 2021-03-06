<?php
namespace Imunew\Pipeline\Pipe;

/**
 * Class Pipes
 * @package Imunew\Pipeline\Pipe
 */
class Pipes implements PipesInterface
{
    /** @var callable[] */
    private $pipes;

    /**
     * Pipes constructor.
     */
    public function __construct()
    {
        $this->pipes = [];
    }

    /**
     * {@inheritdoc}
     */
    public function add($order, callable $pipe)
    {
        assert(is_int($order));

        $pipes = clone $this;
        $pipes->pipes[$order] = $pipe;
        ksort($pipes->pipes);

        return $pipes;
    }

    /**
     * {@inheritdoc}
     */
    public function merge($pipes)
    {
        $merged = clone $this;
        foreach ($pipes as $order => $pipe) {
            $merged = $merged->add($order, $pipe);
        }

        return $merged;
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->pipes);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        return next($this->pipes);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->pipes);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        return reset($this->pipes);
    }
}
