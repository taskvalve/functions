# TaskValve Functions

## Installation

```
composer require taskvalve/functions
```

## Configuration

```
    // config/services.php

    'taskvalve' => [
        'api_key' => env('TASKVALVE_API_KEY'),
    ],
```

```
#.env

TASKVALVE_API_KEY=[YOUR_API KEY}
```

## Usage

```
use TaskValve\CloudFunction;
use Workflow\ActivityStub;
use Workflow\Workflow;
use Workflow\WorkflowStub;

class MyWorkflow extends Workflow
{
    public function execute()
    {
        return yield ActivityStub::make(CloudFunction::class, 'my-function');
    }
}
```
