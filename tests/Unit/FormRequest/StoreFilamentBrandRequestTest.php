<?php

namespace Tests\Unit\FormRequest;

use App\Http\Requests\StoreFilamentBrandRequest;
use Tests\TestCase;

class StoreFilamentBrandRequestTest extends TestCase
{
    private StoreFilamentBrandRequest $storeFilamentBrandRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storeFilamentBrandRequest = new StoreFilamentBrandRequest();
    }
    /**
     * @test
     */
    public function it_has_rules_set_up_as_expected(): void
    {
        $this->assertEquals(
            [
                'name' => 'required|string|max:255',
            ],
            $this->storeFilamentBrandRequest->rules()
        );
    }
}
