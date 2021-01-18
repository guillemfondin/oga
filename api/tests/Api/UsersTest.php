<?php

namespace App\Tests\Api;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;

class UsersTest extends ApiTestCase
{
    private const USER_EMAIL = 'guillem.fondin@hotmail.fr';

//    private ?int $userId = null;

    public function testCreateUser(): void
    {
        $response = static::createClient()->request(Request::METHOD_POST, 'https://localhost/users', ['json' => [
            'email' => self::USER_EMAIL,
            'password' => 'password'
        ]]);

//        $this->userId = json_decode($response->getContent())->id;

        $this->assertResponseStatusCodeSame(201);
        $this->assertJsonContains([
            '@context' => '/contexts/User',
            '@type' => 'User',
            'email' => self::USER_EMAIL,
        ]);
    }

    public function testGetUserCollection(): void
    {
        $response = static::createClient()->request(Request::METHOD_GET, 'https://localhost/users');

        $this->assertResponseStatusCodeSame(200);
        $this->assertJsonContains([
            '@context' => '/contexts/User',
            '@id' => '/users',
            '@type' => 'hydra:Collection'
        ]);
    }
}
