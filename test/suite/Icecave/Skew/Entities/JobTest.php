<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\Job\JobRequestMessage;
use PHPUnit_Framework_TestCase;
use stdClass;

class JobTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->taskDetails = new TaskDetails('abc');
        $this->job = new Job('123', $this->taskDetails);
    }

    public function testFromRequest()
    {
        $payload = new stdClass;

        $request = new JobRequestMessage('123', 'skew.test');
        $request->setTags(['tag1', 'tag2']);
        $request->setPayload($payload);

        $job = Job::fromRequest($request);

        $this->assertInstanceOf(__NAMESPACE__ . '\Job', $job);
        $this->assertSame('123', $job->id());
        $this->assertSame('skew.test', $job->taskDetails()->task());
        $this->assertEquals(new Set(['tag1', 'tag2']), $job->taskDetails()->tags());
        $this->assertSame($payload, $job->taskDetails()->payload());
    }

    public function testSetId()
    {
        $this->assertSame('123', $this->job->id());
        $this->job->setId('456');
        $this->assertSame('456', $this->job->id());
    }

    public function testSetTaskDetails()
    {
        $taskDetails = new TaskDetails('def');
        $this->assertSame($this->taskDetails, $this->job->taskDetails());
        $this->job->setTaskDetails($taskDetails);
        $this->assertSame($taskDetails, $this->job->taskDetails());
    }
}
