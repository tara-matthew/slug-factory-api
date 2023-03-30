<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Rules\Password;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_defaults_set_up_as_expected(): void
    {
        $password = new Password(8);
//        dd($password::defaults());
        $this->assertEquals([
            'min' => 8
        ], $password::defaults());
    }
}
