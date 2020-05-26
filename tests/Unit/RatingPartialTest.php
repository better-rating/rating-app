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
        $ratingPartial = factory(RatingPartial::class)->create();
        $this->assertTrue($ratingPartial->exists);
    }

    public function test_creation_with_explicit_user()
    {
        $this->loginWithFakeUser();
        $ratingPartial = factory(RatingPartial::class)->create(['user_id' => 2]);
        $this->assertTrue($ratingPartial->exists);
        $this->assertTrue($ratingPartial->user_id === 2);
    }

    public function test_hashids()
    {
        $this->loginWithFakeUser();
        $ratingPartial = factory(RatingPartial::class)->create();
        $this->assertIsString($ratingPartial->hashid);
    }

    public function test_empty_labels_save()
    {
        $this->loginWithFakeUser();
        $ratingPartial = factory(RatingPartial::class)->create(['labels' => []]);
        $this->assertTrue($ratingPartial->exists);
    }

    public function test_simple_labels_attribute()
    {
        $ratingPartial = factory(RatingPartial::class)->make();
        $this->assertNotEmpty($ratingPartial->simple_labels);
        $this->assertStringEndsNotWith('/', $ratingPartial->simple_labels);

        $ratingPartial = factory(RatingPartial::class)->make(['labels' => []]);
        $this->assertEmpty($ratingPartial->simple_labels);
    }
}
