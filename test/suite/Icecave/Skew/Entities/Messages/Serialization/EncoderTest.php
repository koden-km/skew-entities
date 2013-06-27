<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\Job\JobAcceptMessage;
use Icecave\Skew\Entities\Messages\Job\JobCompleteMessage;
use Icecave\Skew\Entities\Messages\Job\JobErrorMessage;
use Icecave\Skew\Entities\Messages\Job\JobLogMessage;
use Icecave\Skew\Entities\Messages\Job\JobProgressMessage;
use Icecave\Skew\Entities\Messages\Job\JobRejectMessage;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use Icecave\Skew\Entities\Messages\Job\LogLevel;
use Icecave\Skew\Entities\Messages\Processor\ProcessorReadyMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorShutdownMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStartMessage;
use Icecave\Skew\Entities\Messages\Processor\ProcessorStopMessage;
use Icecave\Skew\Entities\Priority;
use PHPUnit_Framework_TestCase;

/**
 * @covers Icecave\Skew\Entities\Messages\Serialization\Encoder
 * @covers Icecave\Skew\Entities\Messages\Serialization\EncoderVisitor
 */
class EncoderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->encoder = new Encoder;
    }

    public function testInstance()
    {
        $encoder = Encoder::instance();

        $this->assertInstanceOf(__NAMESPACE__ . '\Encoder', $encoder);
        $this->assertSame($encoder, Encoder::instance());
    }

    public function testDecodeJobAwareMessageWithoutJob()
    {
        $expected = ['type' => 'job.accept', 'processor' => 'abc', 'retry' => true];

        $message = new JobAcceptMessage(true);
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeProcessorAwareMessageWithoutProcessor()
    {
        $expected = ['type' => 'job.accept', 'job' => '123', 'retry' => true];

        $message = new JobAcceptMessage(true);
        $message->setJobId('123');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobAcceptMessage()
    {
        $expected = ['type' => 'job.accept', 'job' => '123', 'processor' => 'abc', 'retry' => true];

        $message = new JobAcceptMessage(true);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobCompleteMessage()
    {
        $expected = ['type' => 'job.complete', 'job' => '123', 'processor' => 'abc'];

        $message = new JobCompleteMessage;
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobErrorMessage()
    {
        $expected = ['type' => 'job.error', 'job' => '123', 'processor' => 'abc', 'reason' => 'The reason!', 'retry' => true];

        $message = new JobErrorMessage('The reason!', true);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobLogMessage()
    {
        $expected = ['type' => 'job.log', 'job' => '123', 'processor' => 'abc', 'level' => 'debug', 'message' => 'The message!'];

        $message = new JobLogMessage(LogLevel::DEBUG(), 'The message!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobProgressMessage()
    {
        $expected = ['type' => 'job.progress', 'job' => '123', 'processor' => 'abc', 'progress' => 0.5];

        $message = new JobProgressMessage(0.5);
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobProgressMessageWithStatus()
    {
        $expected = ['type' => 'job.progress', 'job' => '123', 'processor' => 'abc', 'progress' => 0.5, 'status' => 'The status!'];

        $message = new JobProgressMessage(0.5, 'The status!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobRejectMessage()
    {
        $expected = ['type' => 'job.reject', 'job' => '123', 'processor' => 'abc', 'reason' => 'The reason!'];

        $message = new JobRejectMessage('The reason!');
        $message->setJobId('123');
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeJobRequestMessage()
    {
        $expected = ['type' => 'job.request', 'job' => '123', 'priority' => 'high', 'task' => 'xyz', 'payload' => [ 'foo' => 'bar' ], 'tags' => [ 'a', 'b', 'c' ]];

        $message = new JobRequestMessage('123', 'xyz');
        $message->setPriority(Priority::HIGH());
        $message->setTags(['a', 'b', 'c']);
        $message->setPayload(['foo' => 'bar']);

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeProcessorReadyMessage()
    {
        $expected = ['type' => 'processor.ready', 'processor' => 'abc'];

        $message = new ProcessorReadyMessage;
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeProcessorShutdownMessage()
    {
        $expected = ['type' => 'processor.shutdown', 'processor' => 'abc'];

        $message = new ProcessorShutdownMessage;
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeProcessorStartMessage()
    {
        $expected = ['type' => 'processor.start', 'processor' => 'abc', 'capabilities' => [ 'a', 'b', 'c' ]];

        $message = new ProcessorStartMessage;
        $message->setProcessor('abc');
        $message->setCapabilities([ 'a', 'b', 'c' ]);

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }

    public function testDecodeProcessorStopMessage()
    {
        $expected = ['type' => 'processor.stop', 'processor' => 'abc'];

        $message = new ProcessorStopMessage;
        $message->setProcessor('abc');

        $this->assertEquals((object) $expected, $this->encoder->encode($message));
    }
}
