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
        $this->job = new Job('123', 'skew.test');
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
        $this->assertSame('skew.test', $job->task());
        $this->assertEquals(new Set(['tag1', 'tag2']), $job->tags());
        $this->assertSame($payload, $job->payload());
    }

    public function testSetId()
    {
        $this->assertSame('123', $this->job->id());
        $this->job->setId('456');
        $this->assertSame('456', $this->job->id());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetTask()
    {
        $this->assertSame('skew.test', $this->job->task());
        $this->job->setTask('skew.other');
        $this->assertSame('skew.other', $this->job->task());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetTags()
    {
        $this->assertEquals(new Set, $this->job->tags());
        $this->job->setTags(['tag1', 'tag2']);
        $this->assertEquals(new Set(['tag1', 'tag2']), $this->job->tags());
    }

    /**
     * @covers Icecave\Skew\Entities\JobDetailsTrait
     */
    public function testSetPayload()
    {
        $payload = new stdClass;
        $this->assertNull($this->job->payload());
        $this->job->setPayload($payload);
        $this->assertSame($payload, $this->job->payload());
    }
}
