<?php
namespace Alt3\CakeTokens\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TokensFixture.
 */
class TokensFixture extends TestFixture
{
    /**
     * Table name.
     *
     * @var string
     */
    public $table = 'alt3_cake_tokens';

    /**
     * Fields.
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'token' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'category' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'foreign_alias' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'foreign_table' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'foreign_key' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'payload' => ['type' => 'text', 'length' => null, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null],
        'lifetime' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'use_once' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null],
        'status' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'expires' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'ALT3_TOKEN_CATEGORY' => ['type' => 'index', 'columns' => ['category'], 'length' => []],
            'ALT3_TOKEN_STATUS' => ['type' => 'index', 'columns' => ['status'], 'length' => []],
            'ALT3_TOKEN_MODEL' => ['type' => 'index', 'columns' => ['foreign_alias', 'foreign_table', 'foreign_key'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'ALT3_TOKEN_UNIQUE' => ['type' => 'unique', 'columns' => ['token'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records.
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'token' => '111111',
            'category' => null,
            'foreign_alias' => null,
            'foreign_table' => null,
            'foreign_key' => null,
            'payload' => null,
            'lifetime' => '+3 days',
            'use_once' => 1,
            'status' => 0,
            'created' => '2017-01-01 01:11:11',
            'modified' => null,
            'expires' => '2017-01-01 01:11:11'
        ],
        [
            'id' => 2,
            'token' => '222222',
            'category' => 'password-reset',
            'foreign_alias' => null,
            'foreign_table' => null,
            'foreign_key' => null,
            'payload' => null,
            'lifetime' => '+3 days',
            'use_once' => 1,
            'status' => 0,
            'created' => '2017-01-01 02:22:22',
            'modified' => null,
            'expires' => '2017-01-01 02:22:22'
        ],
        [
            'id' => 3,
            'token' => '333333',
            'category' => 'password-reset',
            'foreign_alias' => null,
            'foreign_table' => null,
            'foreign_key' => null,
            'payload' => null,
            'lifetime' => '+3 days',
            'use_once' => 1,
            'status' => 0,
            'created' => '2017-01-01 03:33:33',
            'modified' => null,
            'expires' => '2017-01-01 03:33:33'
        ],
        [
            'id' => 4,
            'token' => '444444',
            'category' => 'coupon',
            'foreign_alias' => null,
            'foreign_table' => null,
            'foreign_key' => null,
            'payload' => null,
            'lifetime' => '+3 days',
            'use_once' => 1,
            'status' => 1,
            'created' => '2017-01-01 04:44:44',
            'modified' => null,
            'expires' => '2017-01-01 04:44:44'
        ],
    ];
}
