<?php
namespace Icecave\Skew\Entities\Messages;

use Phake;
use PHPUnit_Framework_TestCase;

class AbstractVisitorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->visitor = Phake::partialMock(__NAMESPACE__ . '\AbstractVisitor');
    }

    /**
     * @dataProvider messages
     */
    public function testVisit($message)
    {
        $exceptionMessage = sprintf(
            'Visitor "%s" can not visit message type "%s".',
            get_class($this->visitor),
            $message->type()
        );

        $this->setExpectedException('LogicException', $exceptionMessage);
        $message->accept($this->visitor);
    }

    public function messages()
    {
        return array(
            array(new Job\JobAcceptMessage),
            array(new Job\JobCompleteMessage),
            array(new Job\JobErrorMessage('Error!')),
            array(new Job\JobLogMessage(Job\LogLevel::DEBUG(), 'Message!')),
            array(new Job\JobProgressMessage(0.5)),
            array(new Job\JobRejectMessage('Rejected!')),
            array(new Job\JobRequestMessage('123', 'foo')),
            array(new Processor\ProcessorReadyMessage),
            array(new Processor\ProcessorShutdownMessage),
            array(new Processor\ProcessorStartMessage),
            array(new Processor\ProcessorStopMessage),
        );
    }
}
