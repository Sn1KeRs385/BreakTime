<?php

namespace Tests\Feature\Api\V1;

use Illuminate\Auth\Access\AuthorizationException;
use Tests\Feature\Api\V1\Helpers\PlaceControllerTestHelper;
use Tests\TestCase;

class PlaceControllerTest extends TestCase
{
    use PlaceControllerTestHelper;

    protected static string $URL = "api/v1/places";

    public function testAll()
    {
        $user = $this->createUser();
        $institution = $this->allGenerator($user);

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->allJsonStructure()));

        $response->assertJsonCount($institution->places()->count(), 'data');
    }

    public function testAllWhenNotAcceptedInvite()
    {
        $user = $this->createUser();
        $institution = $this->allWhenNotAcceptedInviteGenerator($user);

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));
    }

    public function testAllWhenNotInstitutionUser()
    {
        $user = $this->createUser();
        $institution = $this->allWhenNotInstitutionUser();

        $response = $this->actingAs($user, 'api')
            ->json('GET', self::$URL, ['institution_id' => $institution->id]);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));
    }
}
