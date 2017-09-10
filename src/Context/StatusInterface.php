<?php
namespace Imunew\Pipeline\Context;

/**
 * Interface StatusInterface
 * @package Imunew\Pipeline
 */
interface StatusInterface
{
    /**
     * @return StatusInterface
     */
    public static function initialize();

    /**
     * @return StatusInterface
     */
    public static function start();

    /**
     * @return StatusInterface
     */
    public static function stop();

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
