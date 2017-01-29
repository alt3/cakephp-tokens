<?php
namespace Alt3\CakeTokens\Test\TestCase\Model\Table;

use Alt3\Tokens\ManualToken;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * Alt3\CakeTokens\Model\Table\TokensTable Test Case.
 */
class TokensTableTest extends TestCase
{

    /**
     * Test subject.
     *
     * @var \Alt3\CakeTokens\Model\Table\TokensTable
     */
    public $Tokens;

    /**
     * Will hold the newly created Token record.
     *
     * @var \Cake\ORM\Entity
     */
    public $freshEntity;

    /**
     * Fixtures.
     *
     * @var array
     */
    public $fixtures = [
        'plugin.alt3/cake_tokens.tokens'
    ];

    /**
     * setUp method.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tokens') ? [] : ['className' => 'Alt3\CakeTokens\Model\Table\TokensTable'];
        $this->Tokens = TableRegistry::get('Tokens', $config);
    }

    /**
     * tearDown method.
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tokens);

        parent::tearDown();
    }

    /**
     * Make sure the table is using expected defaults.
     */
    public function testConfig()
    {
        $this->assertSame('alt3_cake_tokens', $this->Tokens->table());
        $this->assertSame('Alt3\CakeTokens\Model\Entity\Token', $this->Tokens->entityClass());
        $this->assertFalse($this->Tokens->hasBehavior('Timestamp'));
    }

    /**
     * Test findValidToken method. Will only succeed if these threeconditions match:
     *
     * - Token value exists
     * - Token has not expired
     * - Token has status 0
     *
     * @return void
     */
    public function testFindValidToken()
    {
        // create a non-expired record
        $token = new ManualToken('TEST-TOKEN');

        $entity = $this->Tokens->newEntity($token->toArray());
        $this->Tokens->save($entity);

        // test successful find
        $query = $this->Tokens->find('validToken', ['token' => 'TEST-TOKEN']);
        $result = $query->first();

        $this->assertInstanceOf('Alt3\CakeTokens\Model\Entity\Token', $result);
        $this->assertSame('TEST-TOKEN', $result->token);

        // test fail
        $query = $this->Tokens->find('validToken', ['token' => 'NON-EXISTENT-TOKEN']);
        $this->assertCount(0, $query);
    }

    /**
     * Test setStatus method.
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Status argument must be an integer
     */
    public function testSetStatus()
    {
        // make sure the entity with id 3 exists and has status 0
        $entity = $this->Tokens->get(3);
        $this->assertInstanceOf('Alt3\CakeTokens\Model\Entity\Token', $entity);
        $this->assertSame(0, $entity->get('status'));

        // set status to 1
        $this->Tokens->setStatus(3, 1);
        $entity = $this->Tokens->get(3);
        $this->assertInstanceOf('Alt3\CakeTokens\Model\Entity\Token', $entity);
        $this->assertSame(1, $entity->get('status'));

        // throw the non-int argument exception
        $this->Tokens->setStatus(1, 'THIS-IS-NO-INT');
    }

    /**
     * Test findAllActive method.
     *
     * @return void
     */
    public function testFindAllActive()
    {
        $result = $this->Tokens->find('allActive');
        $this->assertCount(3, $result);
    }

    /**
     * Test deleteAllExpired method.
     *
     * @return void
     */
    public function testDeleteAllExpired()
    {
        // create a non-expired record
        $token = new ManualToken('TEST-TOKEN');
        $entity = $this->Tokens->newEntity($token->toArray());
        $this->Tokens->save($entity);

        // make sure we now have 5 records
        $query = $this->Tokens->find()->all();
        $this->assertCount(5, $query);

        // delete expired tokens, only the new one should remain
        $this->Tokens->deleteAllExpired();
        $query = $this->Tokens->find()->all();
        $this->assertCount(1, $query);
    }

    /**
     * Test deleteAllWithStatus method.
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Status argument must be an integer
     */
    public function testDeleteAllWithStatus()
    {
        // make sure we have 1 record with status 1
        $query = $this->Tokens->find()
            ->where(['status' => 1])
            ->all();
        $this->assertCount(1, $query);

        // delete record with status 1
        $this->Tokens->deleteAllWithStatus(1);
        $query = $this->Tokens->find()->all();

        $query = $this->Tokens->find()
            ->where(['status' => 1])
            ->all();
        $this->assertCount(0, $query);

        // throw the non-int argument exception
        $this->Tokens->deleteAllWithStatus('THIS-IS-NO-INT');
    }
}
