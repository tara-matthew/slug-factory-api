<?php

namespace Tests\Unit\FormRequest;

use App\Http\Requests\StorePrintedDesignRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

class StorePrintedDesignRequestTest extends TestCase
{
    use AdditionalAssertions;
    use RefreshDatabase;

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
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'filament_brand_id' => 'required',
            'filament_colour_id' => 'required',
            'images.*.url' => 'required'
        ],
            $this->printedDesignRequest->rules()
        );
    }
}
