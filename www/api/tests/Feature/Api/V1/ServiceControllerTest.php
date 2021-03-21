<?php

namespace Tests\Feature\Api\V1;

use App\Models\Service;
use Illuminate\Auth\Access\AuthorizationException;
use Tests\Feature\Api\V1\Helpers\ServiceControllerTestHelper;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    use ServiceControllerTestHelper;

    protected static string $URL = "api/v1/services";

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

        $response->assertJsonCount($institution->services()->count(), 'data');
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

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('services', $data);
    }

    public function testStoreWhenNameAlreadyExists()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreWhenNameAlreadyExists($user);

        $serviceId =  $data['service_id'];
        unset($data['service_id']);

        $this->assertDatabaseHas('services', $data);
        $countBeforeRequest = Service::count();

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $response->assertJson(['data' => ['id' => $serviceId]]);

        $countAfterRequest = Service::count();

        $this->assertEquals($countBeforeRequest, $countAfterRequest);
    }

    public function testStoreAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreAdmin($user);

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('services', $data);
    }

    public function testStoreNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotAccess($user);

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('services', $data);
    }

    public function testStoreNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataStoreNotInstitutionUser();

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('POST', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseMissing('services', $data);
    }

    public function testUpdate()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdate($user);

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $jsonData = $data;
        $jsonData['price'] = round($jsonData['price'], 2);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($jsonData))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('services', $data);
    }

    public function testUpdateWithoutChange()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithoutChange($user);

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $jsonData = $data;
        $jsonData['price'] = round($jsonData['price'], 2);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($jsonData))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('services', $data);
    }

    public function testUpdateAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateAdmin($user);

        $this->assertDatabaseMissing('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);


        $jsonData = $data;
        $jsonData['price'] = round($jsonData['price'], 2);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson($jsonData))
            ->assertJsonStructure($this->getBaseSuccessStructure($this->baseJsonStructure()));

        $this->assertDatabaseHas('services', $data);
    }

    public function testUpdateWithSameName()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateWithSameName($user);

        $this->assertDatabaseMissing('services', $data);

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

        $this->assertDatabaseMissing('services', $data);
    }


    public function testUpdateNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotAccess($user);

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('services', $data);
    }

    public function testUpdateNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataUpdateNotInstitutionUser();

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('PUT', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('services', $data);
    }


    public function testDelete()
    {
        $user = $this->createUser();
        $data = $this->getDataDelete($user);
        
        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure());

        $this->assertSoftDeleted('services', $data);
    }

    public function testDeleteAdmin()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteAdmin($user);

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure());

        $this->assertSoftDeleted('services', $data);
    }

    public function testDeleteNotAccess()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteNotAccess($user);
        $data['deleted_at'] = null;

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('services', $data);
    }

    public function testDeleteNotInstitutionUser()
    {
        $user = $this->createUser();
        $data = $this->getDataDeleteNotInstitutionUser();
        $data['deleted_at'] = null;

        $this->assertDatabaseHas('services', $data);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', self::$URL, $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseErrorJson([], [AuthorizationException::class]));

        $this->assertDatabaseHas('services', $data);
    }
}
