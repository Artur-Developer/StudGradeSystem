<?php

use yii\db\Migration;

/**
 * Handles the creation of table `testing`.
 * Has foreign keys to the tables:
 *
 * - `subject`
 * - `question_answers`
 */
class m180130_153603_create_testing_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('testing', [
            'id' => $this->primaryKey(),
            'name_test' => $this->string(255)->notNull()->unique(),
            'subject_id' => $this->integer()->notNull(),
            'description' => $this->string(255),
            'user_create' => $this->string(100),
            'create_date' => $this->dateTime(),
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-testing-subject_id',
            'testing',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-testing-subject_id',
            'testing',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-testing-subject_id',
            'testing'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-testing-subject_id',
            'testing'
        );



        $this->dropTable('testing');
    }
}
