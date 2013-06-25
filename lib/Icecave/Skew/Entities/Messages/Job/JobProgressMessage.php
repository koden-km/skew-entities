<?php
namespace Icecave\Skew\Entities\Messages\Job;

use DomainException;
use Icecave\Skew\Entities\Messages\VisitorInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class JobProgressMessage extends AbstractJobMessageFromProcessor
{
    /**
     * @param float       $progress The job's progress (1.0 = 100% complete).
     * @param string|null $status   Human-readable description of the job's status.
     */
    public function __construct($progress = 0.0, $status = null)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->setProgress($progress);
        $this->setStatus($status);

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
     * @return string|null Human-readable description of the job's status.
     */
    public function status()
    {
        $this->typeCheck->status(func_get_args());

        return $this->status;
    }

    /**
     * @param string|null $status Human-readable description of the job's status.
     */
    public function setStatus($status)
    {
        $this->typeCheck->setStatus(func_get_args());

        $this->status = $status;
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
    private $status;
}
