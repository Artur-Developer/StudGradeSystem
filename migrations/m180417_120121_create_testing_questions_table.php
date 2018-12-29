<?php

use yii\db\Migration;

/**
 * Handles the creation of table `testing_questions`.
 */
class m180417_120121_create_testing_questions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('testing_questions', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'testing_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `testing_id`
        $this->createIndex(
            'idx-testing_questions-testing_id',
            'testing_questions',
            'testing_id'
        );

        // add foreign key for table `testing`
        $this->addForeignKey(
            'fk-testing_questions-testing_id',
            'testing_questions',
            'testing_id',
            'testing',
            'id',
            'CASCADE'
        );

        // creates index for column `question_id`
        $this->createIndex(
            'idx-testing_questions-question_id',
            'testing_questions',
            'question_id'
        );

        // add foreign key for table `question_answers`
        $this->addForeignKey(
            'fk-testing_questions-question_id',
            'testing_questions',
            'question_id',
            'questions',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `testing`
        $this->dropForeignKey(
            'fk-testing_questions-testing_id',
            'testing_questions'
        );

        // drops index for column `testing_id`
        $this->dropIndex(
            'idx-testing_questions-testing_id',
            'testing_questions'
        );

        // drops foreign key for table `questions`
        $this->dropForeignKey(
            'fk-testing_questions-question_id',
            'testing_questions'
        );

        // drops index for column `questions_id`
        $this->dropIndex(
            'idx-testing_questions-question_id',
            'testing_questions'
        );

        $this->dropTable('testing_questions');
    }
}
