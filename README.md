# TaskValve Functions

Run TypeScript functions in the cloud from your Laravel PHP workflows!

## Installation

```bash
composer require taskvalve/functions
```

## Configuration

config/services.php

```php
'taskvalve' => [
    'api_key' => env('TASKVALVE_API_KEY'),
],
```
.env

```
TASKVALVE_API_KEY=[YOUR_API KEY}
```

## Usage

```php
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

## Examples

See https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API for `Request` and `Response` documentation.

### Return JSON

```typscript
export default async (request) => {
    return new Response(JSON.stringify({ data: ['test'] }), { 
        headers: { 'content-type': 'application/json' }
    })
}
```

