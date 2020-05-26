<?php

namespace Tests\Unit;

use \App\Models\RatingPartial;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RatingPartialTest extends TestCase
{
    use DatabaseTransactions;

    public function test_creation_with_observer_handling_user_id()
    {
        $this->loginWithFakeUser();
        $rating_partial = factory(RatingPartial::class)->create();
        $this->assertTrue($rating_partial->exists);
    }

    public function test_creation_with_explicit_user()
    {
        $this->loginWithFakeUser();
        $rating_partial = factory(RatingPartial::class)->create(['user_id' => 2]);
        $this->assertTrue($rating_partial->exists);
        $this->assertTrue($rating_partial->user_id === 2);
    }

    public function test_hashids()
    {
        $this->loginWithFakeUser();
        $rating_partial = factory(RatingPartial::class)->create();
        $this->assertIsString($rating_partial->hashid);

    }
}
