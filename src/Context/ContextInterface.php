<?php
namespace Imunew\Pipeline\Context;

/**
 * Interface ContextInterface
 * @package Imunew\Pipeline
 */
interface ContextInterface
{
    /**
     * Context constructor.
     * @param array $data
     */
    public function __construct($data = []);

    /**
     * @param StatusInterface $status
     * @return ContextInterface
     */
    public function setStatus($status);

    /**
     * @param string $key
     * @param $value
     * @return ContextInterface
     */
    public function setData($key, $value);

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getData($key, $default = null);

    /**
     * @return bool
     */
    public function isInitialized();

    /**
     * @return bool
     */
    public function isStarted();

    /**
     * @return bool
     */
    public function isStopped();

}
