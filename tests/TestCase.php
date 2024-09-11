<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\Testing\TestResponse;
use JMac\Testing\Traits\AdditionalAssertions;

abstract class TestCase extends BaseTestCase
{
    use AdditionalAssertions;
    use CreatesApplication;
    use RefreshDatabase;

    public function assertJsonResponseContent(JsonResource $resource, TestResponse $response, ?Request $request = null): void
    {
        $request = $request ?? request();

        $this->assertEquals(
            (new ResourceResponse($resource))->toResponse($request)->content(),
            $response->content()
        );
    }
}
