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
use stdClass;

class DecoderTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->decoder = new Decoder;
    }

    public function testInstance()
    {
        $decoder = Decoder::instance();

        $this->assertInstanceOf(__NAMESPACE__ . '\Decoder', $decoder);
        $this->assertSame($decoder, Decoder::instance());
    }

    public function testDecodeFailure()
    {
        $message = new stdClass;
        $message->type = 'unknown';

        $this->setExpectedException('InvalidArgumentException');
        $this->decoder->decode($message);
    }

    public function testDecodeFailureMissingType()
    {
        $this->setExpectedException('ErrorException', 'Undefined property: stdClass::$type');
        $this->decoder->decode(new stdClass);
    }

    public function testDecodeJobAwareMessageWithoutJob()
    {
        $message = ['type' => 'job.accept', 'processor' => 'abc', 'retry' => true];

        $expected = new JobAcceptMessage(true);
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeProcessorAwareMessageWithoutProcessor()
    {
        $message = ['type' => 'job.accept', 'job' => '123', 'retry' => true];

        $expected = new JobAcceptMessage(true);
        $expected->setJobId('123');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobAcceptMessage()
    {
        $message = ['type' => 'job.accept', 'job' => '123', 'processor' => 'abc', 'retry' => true];

        $expected = new JobAcceptMessage(true);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobCompleteMessage()
    {
        $message = ['type' => 'job.complete', 'job' => '123', 'processor' => 'abc'];

        $expected = new JobCompleteMessage;
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobErrorMessage()
    {
        $message = ['type' => 'job.error', 'job' => '123', 'processor' => 'abc', 'reason' => 'The reason!', 'retry' => true];

        $expected = new JobErrorMessage('The reason!', true);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobLogMessage()
    {
        $message = ['type' => 'job.log', 'job' => '123', 'processor' => 'abc', 'level' => 'debug', 'message' => 'The message!'];

        $expected = new JobLogMessage(LogLevel::DEBUG(), 'The message!');
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobProgressMessage()
    {
        $message = ['type' => 'job.progress', 'job' => '123', 'processor' => 'abc', 'progress' => 0.5];

        $expected = new JobProgressMessage(0.5);
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobProgressMessageWithStatus()
    {
        $message = ['type' => 'job.progress', 'job' => '123', 'processor' => 'abc', 'progress' => 0.5, 'status' => 'The status!'];

        $expected = new JobProgressMessage(0.5, 'The status!');
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobRejectMessage()
    {
        $message = ['type' => 'job.reject', 'job' => '123', 'processor' => 'abc', 'reason' => 'The reason!'];

        $expected = new JobRejectMessage('The reason!');
        $expected->setJobId('123');
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeJobRequestMessage()
    {
        $message = ['type' => 'job.request', 'job' => '123', 'priority' => 'high', 'task' => 'xyz', 'payload' => [ 'foo' => 'bar' ], 'tags' => [ 'a', 'b', 'c' ]];

        $expected = new JobRequestMessage('123', 'xyz');
        $expected->setPriority(Priority::HIGH());
        $expected->setTags(['a', 'b', 'c']);
        $expected->setPayload(['foo' => 'bar']);

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeProcessorReadyMessage()
    {
        $message = ['type' => 'processor.ready', 'processor' => 'abc'];

        $expected = new ProcessorReadyMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeProcessorShutdownMessage()
    {
        $message = ['type' => 'processor.shutdown', 'processor' => 'abc'];

        $expected = new ProcessorShutdownMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeProcessorStartMessage()
    {
        $message = ['type' => 'processor.start', 'processor' => 'abc', 'capabilities' => [ 'a', 'b', 'c' ]];

        $expected = new ProcessorStartMessage;
        $expected->setProcessor('abc');
        $expected->setCapabilities([ 'a', 'b', 'c' ]);

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }

    public function testDecodeProcessorStopMessage()
    {
        $message = ['type' => 'processor.stop', 'processor' => 'abc'];

        $expected = new ProcessorStopMessage;
        $expected->setProcessor('abc');

        $this->assertEquals($expected, $this->decoder->decode((object) $message));
    }
}
