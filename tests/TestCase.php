<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginWithFakeUser()
    {
        $user = new User();
        $user->id = 1;
        $user->name = 'Fake User';

        $this->be($user);
    }
}
