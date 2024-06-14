<?php

namespace Tests\Unit\FormRequest;

use App\Filaments\Brands\Requests\StoreFilamentBrandRequest;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreFilamentBrandRequestTest extends TestCase
{
    private StoreFilamentBrandRequest $storeFilamentBrandRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->storeFilamentBrandRequest = new StoreFilamentBrandRequest();
    }

    #[Test]
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
