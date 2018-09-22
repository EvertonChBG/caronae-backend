<?php

namespace Caronae\Models;


use Tests\TestCase;

class InstitutionTest extends TestCase
{
    /** @test */
    public function should_use_slug_as_route_key()
    {
        $institution = new Institution([
            'id' => 1,
            'slug' => 'uc',
            'name' => 'Universidade Caronaê',
            'authentication_url' => 'http://example.com/login',
        ]);

        $this->assertEquals('uc', $institution->getRouteKey());
    }
}
