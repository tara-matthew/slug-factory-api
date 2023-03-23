<?php

namespace Tests\Feature;

use App\Http\Requests\StorePrintedDesignRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class StorePrintedDesignRequestTest extends TestCase
{
    use AdditionalAssertions;

    private StorePrintedDesignRequest $printedDesignRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->printedDesignRequest = new StorePrintedDesignRequest();
    }

    /**
     * @test
     * @covers \App\Http\Requests\StorePrintedDesignRequest::rules
     */
    public function it_has_rules_set_up_as_expected(): void
    {
        $this->assertEquals(
            [
            'title' => 'required|max:255',
            'description' => 'required'
        ],
            $this->printedDesignRequest->rules()
        );
    }
}
