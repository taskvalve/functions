<?php

declare(strict_types=1);

namespace Tests\Fixtures;

use TaskValve\CloudFunction;
use Workflow\ActivityStub;
use Workflow\Workflow;

class TestWorkflow extends Workflow
{
    public function execute()
    {
        return yield ActivityStub::make(CloudFunction::class, 'test');
    }
}
