<?php

namespace Tests\Unit\Policy;

use Domain\PrintedDesigns\Models\PrintedDesign;
use Domain\PrintedDesigns\Policies\PrintedDesignPolicy;
use Domain\Users\Models\User;
use Tests\TestCase;

class PrintedDesignPolicyTest extends TestCase
{
    private PrintedDesignPolicy $policy;
    private User $user;
    private PrintedDesign $printBelongingToUser;
    private PrintedDesign $printNotBelongingToUser;
    private array $permissionsRequiringSameUserID;

    public function setUp(): void
    {
        parent::setUp();

        $this->policy = new PrintedDesignPolicy();
        $this->user = User::factory()->create();
        $this->printBelongingToUser = PrintedDesign::factory()->for($this->user)->create();
        $this->printNotBelongingToUser = PrintedDesign::factory()->create();
    }

    /**
     * @test
     */
    public function it_has_view_permission_set_up_correctly(): void
    {
        $this->assertTrue($this->policy->view($this->user, $this->printBelongingToUser));
        $this->assertFalse($this->policy->view($this->user, $this->printNotBelongingToUser));
    }

    /**
     * @test
     */
    public function it_has_update_permission_set_up_correctly(): void
    {
        $this->assertTrue($this->policy->update($this->user, $this->printBelongingToUser));
        $this->assertFalse($this->policy->update($this->user, $this->printNotBelongingToUser));
    }

    /**
     * @test
     */
    public function it_has_delete_permission_set_up_correctly(): void
    {
        $this->assertTrue($this->policy->delete($this->user, $this->printBelongingToUser));
        $this->assertFalse($this->policy->delete($this->user, $this->printNotBelongingToUser));
    }
}
