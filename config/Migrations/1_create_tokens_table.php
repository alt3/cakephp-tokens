<?php
use Phinx\Migration\AbstractMigration;

class CreateTokensTable extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('alt3_cake_tokens');

        $table
            ->addColumn('token', 'string', [
                'default' => null,
                'null' => false
            ])
            ->addColumn('category', 'string', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('foreign_alias', 'string', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('foreign_table', 'string', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('foreign_key', 'string', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('payload', 'text', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('lifetime', 'string', [
                'default' => null,
                'null' => false
            ])
            ->addColumn('use_once', 'boolean', [
                'default' => true,
                'null' => true
            ])
            ->addColumn('status', 'integer', [
                'default' => false,
                'null' => true
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => true
            ])
            ->addColumn('expires', 'datetime', [
                'default' => null,
                'null' => false
            ])

            ->addIndex('token', [
                'name' => 'ALT3_TOKEN_UNIQUE',
                'unique' => true
            ])
            ->addIndex('category', [
                'name' => 'ALT3_TOKEN_CATEGORY'
            ])
            ->addIndex('status', [
                'name' => 'ALT3_TOKEN_STATUS'
            ])
            ->addIndex(['foreign_alias', 'foreign_table', 'foreign_key'], [
                'name' => 'ALT3_TOKEN_MODEL'
            ])

            ->create();
    }

    public function down()
    {
        $this->dropTable('alt3_cake_tokens');
    }
}
