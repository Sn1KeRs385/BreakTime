<?php

namespace Tests\Feature\Api\V1;

use App\Models\Place;
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

    public function testStore()
    {
        $user = $this->createUser();
        $data = $this->getDataStore($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('places', $data);
    }

    public function testStoreWhenNameAlreadyExists()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreWhenNameAlreadyExists($user);

        $placeId =  $data['place_id'];
        unset($data['place_id']);

        $this->assertDatabaseHas('places', $data);
        $countBeforeRequest = Place::count();

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $response->assertJson(['data' => ['id' => $placeId]]);

        $countAfterRequest = Place::count();

        $this->assertEquals($countBeforeRequest, $countAfterRequest);
    }

    public function testStoreAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreAdmin($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('places', $data);
    }

    public function testStoreNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotAccess($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('places', $data);
    }

    public function testStoreNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotInstitutionUser();

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('places', $data);
    }

    public function testUpdate()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdate($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($data))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('places', $data);
    }

    public function testUpdateWithoutChange()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithoutChange($user);

        $this->assertDatabaseHas('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($data))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('places', $data);
    }

    public function testUpdateAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateAdmin($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($data))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('places', $data);
    }

    public function testUpdateWithSameName()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithSameName($user);

        $this->assertDatabaseMissing('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([
                [
                    'code' => 422,
                    'field' => 'name',
                    'message' => 'VALIDATION_EXCEPTION'
                ]
            ]));

        $this->assertDatabaseMissing('places', $data);
    }


    public function testUpdateNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotAccess($user);

        $this->assertDatabaseHas('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('places', $data);
    }

    public function testUpdateNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotInstitutionUser();

        $this->assertDatabaseHas('places', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('places', $data);
    }
}
