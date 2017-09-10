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
        return new static(self::$INITIALIZED);
    }

    /**
     * @return StatusInterface
     */
    public static function start()
    {
        return new static(self::$STARTED);
    }

    /**
     * @return StatusInterface
     */
    public static function stop()
    {
        return new static(self::$STOPPED);
    }

    /**
     * @return bool
     */
    public function isInitialized()
    {
        return in_array($this->status, [self::$INITIALIZED]);
    }

    /**
     * @return bool
     */
    public function isStarted()
    {
        return in_array($this->status, [self::$STARTED]);
    }

    /**
     * @return bool
     */
    public function isStopped()
    {
        return in_array($this->status, [self::$STOPPED]);
    }
}
