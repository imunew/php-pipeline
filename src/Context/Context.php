<?php
namespace Imunew\Pipeline\Context;

/**
 * Class Context
 * @package Imunew\Pipeline
 */
class Context implements ContextInterface
{
    /** @var StatusInterface */
    private $status;

    /** @var array */
    private $data;

    /**
     * Context constructor.
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->status = Status::initialize();
        $this->data = $data;
    }

    /**
     * @param StatusInterface $status
     * @return ContextInterface
     */
    public function setStatus($status)
    {
        $context = clone $this;
        $context->status = $status;
        return $context;
    }

    /**
     * @param string $key
     * @param $value
     * @return ContextInterface
     */
    public function setData($key, $value)
    {
        $context = clone $this;
        $context->data[$key] = $value;
        return $context;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function getData($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return $default;
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        return $this->status->isInitialized();
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return $this->status->isStarted();
    }

    /**
     * @return bool
     */
    public function isStopped()
    {
        return $this->status->isStopped();
    }

}
