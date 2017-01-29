<?php
namespace Alt3\CakeTokens\Model\Entity;

use Cake\TestSuite\TestCase;

/**
 * Separate test class since this exception will only be thrown when no
 * fixtures are loaded.
 */
class TokenEntityTest extends TestCase
{
    /**
     * setUp method executed before every testMethod.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * tearDown method executed after every testMethod.
     */
    public function tearDown()
    {
        parent::tearDownAfterClass();
    }

    /**
     * Make sure that ????
     */
    public function testMissingTablesException()
    {
        //$this->markTestIncomplete();
    }
}
