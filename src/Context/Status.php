<?php
namespace Imunew\Pipeline\Context;

/**
 * Class Status
 * @package Imunew\Pipeline
 */
class Status implements StatusInterface
{
    /** @var string */
    private static $INITIALIZED = 'initialized';

    /** @var string */
    private static $STARTED = 'started';

    /** @var string */
    private static $STOPPED = 'stopped';

    /** @var string */
    private $status;

    /**
     * Status constructor.
     * @param string $status
     */
    private function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * @return StatusInterface
     */
    public static function initialize()
    {
        return new static(static::$INITIALIZED);
    }

    /**
     * @return StatusInterface
     */
    public static function start()
    {
        return new static(static::$STARTED);
    }

    /**
     * @return StatusInterface
     */
    public static function stop()
    {
        return new static(static::$STOPPED);
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        return in_array($this->status, [static::$INITIALIZED]);
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return in_array($this->status, [static::$STARTED]);
    }

    /**
     * @return bool
     */
    public function isStopped()
    {
        return in_array($this->status, [static::$STOPPED]);
    }
}
