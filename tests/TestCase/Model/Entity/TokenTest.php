<?php
namespace Alt3\CakeTokens\Test\TestCase\Model\Entity;

use Alt3\CakeTokens\Model\Entity\Token;
use Cake\TestSuite\TestCase;

/**
 * Alt3\CakeTokens\Model\Entity\Token Test Case.
 */
class TokenTest extends TestCase
{

    /**
     * Test subject.
     *
     * @var \Alt3\CakeTokens\Model\Entity\Token
     */
    public $Token;

    /**
     * setUp method.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Token = new Token();
    }

    /**
     * tearDown method.
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Token);

        parent::tearDown();
    }

    /**
     * Test initial setup.
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
