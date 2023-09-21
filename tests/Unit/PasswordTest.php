<?php

namespace Tests\Unit;

use Illuminate\Validation\Rules\Password;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @test
     * @covers \Illuminate\Validation\Rules\Password::defaults
     */
    public function it_has_defaults_set_up_as_expected(): void
    {
        $this->assertEquals(Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), Password::defaults());
    }
}
