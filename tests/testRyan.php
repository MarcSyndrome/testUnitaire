<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Tests version Ryan ( de base )
 * Verifie l'existance du bordel
 */
class ContactControllerTest extends WebTestCase
{
    public function testContactForm()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        //$this->assertTrue(True);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertCount(1, $crawler->filter('form'));
        $this->assertCount(1, $crawler->filter('input[name="contact[name]"]'));
        $this->assertCount(1, $crawler->filter('input[name="contact[email]"]'));
        $this->assertCount(1, $crawler->filter('input[name="contact[password]"]'));
        $this->assertCount(1, $crawler->filter('button[type="submit"]'));
    }
}
