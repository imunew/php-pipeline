<?php
namespace Imunew\Pipeline;

use Imunew\Pipeline\Context\ContextInterface;
use Imunew\Pipeline\Context\Status;
use Imunew\Pipeline\Pipe\PipesInterface;
use RuntimeException;

/**
 * Class Pipeline
 * @package Imunew\Pipeline
 */
class Pipeline
{
    /** @var PipesInterface */
    private $pipes;

    /**
     * Pipeline constructor.
     * @param PipesInterface $pipes
     */
    public function __construct(PipesInterface $pipes)
    {
        $this->pipes = $pipes;
    }

    /**
     * @param ContextInterface $context
     * @return ContextInterface
     */
    public function process(ContextInterface $context)
    {
        $context = $context->setStatus(Status::start());

        foreach ($this->pipes as $pipe)
        {
            /** @var callable $pipe */
            $context = $pipe($context);

            if (!$context instanceof ContextInterface)
            {
                throw new RuntimeException('$context must be instance of ContextInterface.' );
            }
            if ($context->isStopped())
            {
                break;
            }
        }

        return $context->setStatus(Status::stop());
    }

}
