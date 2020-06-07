<?php

namespace Tests\Unit;

use \App\Models\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_creation_with_observer_handling_user_id()
    {
        $this->loginWithFakeUser();
        $profile = factory(Profile::class)->create();
        $this->assertTrue($profile->exists);
    }

    public function test_creation_with_explicit_user()
    {
        $this->loginWithFakeUser();
        $profile = factory(Profile::class)->create(['user_id' => 2]);
        $this->assertTrue($profile->exists);
        $this->assertTrue($profile->user_id === 2);
    }

    public function test_hashids()
    {
        $this->loginWithFakeUser();
        $profile = factory(Profile::class)->create();
        $this->assertIsString($profile->hashid);
    }
}
