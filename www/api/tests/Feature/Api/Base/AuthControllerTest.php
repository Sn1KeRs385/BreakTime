<?php

namespace Tests\Feature\Api\Base;

use App\Models\User;
use Illuminate\Support\Arr;
use Tests\Feature\Api\Base\Helpers\AuthControllerTestHelper;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use AuthControllerTestHelper;

    public function testSignUp()
    {
        $data = $this->getDataSignUp();
        $response = $this->post('api/auth/signup', $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure(self::$TOKEN_STRUCTURE));

        $user = User::firstWhere(Arr::only($data, [
            'last_name',
            'first_name',
            'email',
        ]));
        $this->assertNotEquals($user, null);

        $this->assertDatabaseHas('oauth_access_tokens', [
            'user_id' => $user->id,
        ]);
    }

    public function testLogin()
    {
        $data = $this->getDataLogin();
        $response = $this->post('api/auth/login', $data);

        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson())
            ->assertJsonStructure($this->getBaseSuccessStructure(self::$TOKEN_STRUCTURE));

        $user = User::firstWhere(Arr::only($data, [ 'email']));

        $this->assertNotEquals($user, null);

        $this->assertDatabaseHas('oauth_access_tokens', [
            'user_id' => $user->id,
        ]);
    }

    public function testLogout()
    {
        $data = $this->getDataLogout();

        $this->assertDatabaseHas('oauth_access_tokens', [
            'user_id' => $data['user']->id,
            'revoked' => false,
        ]);
        $token = $data['token']->accessToken;

        $response = $this->withHeader('Authorization', "Bearer $token")
            ->post('api/auth/logout');
        
        $response
            ->assertStatus(200)
            ->assertJson($this->getBaseSuccessJson());

        $this->assertDatabaseHas('oauth_access_tokens', [
            'user_id' => $data['user']->id,
            'revoked' => true,
        ]);
    }
}
