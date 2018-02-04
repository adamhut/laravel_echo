<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UuidTraitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generate_a_uuid()
    {
        $user = factory('App\User')->create();

        $this->assertTrue(isset($user->uuid));
    }
}
