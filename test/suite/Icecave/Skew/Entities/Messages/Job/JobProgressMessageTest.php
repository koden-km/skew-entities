<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Phake;
use PHPUnit_Framework_TestCase;

class JobProgressMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new JobProgressMessage(0.5, 'The status!');
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Flow\DaemonToClientMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Flow\ProcessorMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\Flow\ClientMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\Messages\Flow\DaemonToProcessorMessageInterface', $this->message);

        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Job\JobAwareMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\Messages\Processor\ProcessorAwareMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('job.progress', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Job\AbstractJobMessage
     */
    public function testSetJobId()
    {
        $this->message->setJobId('abc');
        $this->assertSame('abc', $this->message->jobId());
    }

    /**
     * @covers Icecave\Skew\Entities\Messages\Processor\ProcessorTrait
     */
    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    public function testSetProgress()
    {
        $this->assertSame(0.5, $this->message->progress());
        $this->message->setProgress(1.0);
        $this->assertSame(1.0, $this->message->progress());
    }

    public function testSetProgressFailureOverflow()
    {
        $this->setExpectedException('DomainException', 'Progress must be between 0.0 and 1.0, inclusive.');
        $this->message->setProgress(1.1);
    }

    public function testSetProgressFailureUnderflow()
    {
        $this->setExpectedException('DomainException', 'Progress must be between 0.0 and 1.0, inclusive.');
        $this->message->setProgress(-1.0);
    }

    public function testSetStatus()
    {
        $this->assertSame('The status!', $this->message->status());
        $this->message->setStatus('New status!');
        $this->assertSame('New status!', $this->message->status());
        $this->message->setStatus(null);
        $this->assertNull($this->message->status());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\Messages\VisitorInterface');

        Phake::when($visitor)
            ->visitJobProgressMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
