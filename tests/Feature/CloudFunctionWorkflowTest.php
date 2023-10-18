<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fixtures\TestWorkflow;
use Tests\TestCase;
use Workflow\WorkflowStub;

final class CloudFunctionWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function testCompleted(): void
    {
        $workflow = WorkflowStub::make(TestWorkflow::class);

        $workflow->start();

        while ($workflow->running());

        $this->assertSame('', $workflow->output());
    }
}
