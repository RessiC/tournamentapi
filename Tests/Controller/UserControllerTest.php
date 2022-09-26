<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testGetUserPlayer(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/test');
        $this->assertResponseStatusCodeSame(200);
    }
}