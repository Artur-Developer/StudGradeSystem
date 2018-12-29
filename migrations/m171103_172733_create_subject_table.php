<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subject`.
 */
class m171103_172733_create_subject_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('subject', [
            'id' => $this->primaryKey(),
            'name_subject' => $this->string(100)->notNull()->unique(),
            'create_data' => $this->dateTime(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('subject');
    }
}
