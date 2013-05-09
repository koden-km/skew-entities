<?php
namespace Icecave\Skew\Entities\Messages\Job;

use DomainException;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobProgressMessage extends AbstractJobMessageFromProcessor
{
    /**
     * @param float $progress The job's progress (1.0 = 100% complete).
     */
    public function __construct($progress = 0.0)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setProgress($progress);

        parent::__construct();
    }

    /**
     * @return string
     */
    public function type()
    {
        $this->typeCheck->type(func_get_args());

        return 'job.progress';
    }

    /**
     * @return float The job's progress (1.0 = 100% complete).
     */
    public function progress()
    {
        $this->typeCheck->progress(func_get_args());

        return $this->progress;
    }

    /**
     * @param float $progress The job's progress (1.0 = 100% complete).
     */
    public function setProgress($progress)
    {
        $this->typeCheck->setProgress(func_get_args());

        if ($progress < 0.0 || $progress > 1.0) {
            throw new DomainException('Progress must be between 0.0 and 1.0, inclusive.');
        }

        $this->progress = $progress;
    }

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor)
    {
        $this->typeCheck->accept(func_get_args());

        return $visitor->visitJobProgressMessage($this);
    }

    private $typeCheck;
    private $progress;
}
