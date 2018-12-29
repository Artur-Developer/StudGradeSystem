<?php

use yii\db\Migration;

/**
 * Handles the creation of table `auditories`.
 */
class m180130_115748_create_auditories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('auditories', [
            'id' => $this->primaryKey(),
            'capacity' => $this->integer(),
            'number' => $this->string(30)->notNull(),
            'type' => $this->string(35)->defaultValue('Стандартная'),
            'description' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('auditories');
    }
}
