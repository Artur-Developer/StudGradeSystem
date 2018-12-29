<?php

use yii\db\Migration;

/**
 * Handles the creation of table `question_answers`.
 * Has foreign keys to the tables:
 *
 * - `questions`
 */
class m180130_150342_create_question_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('question_answers', [
            'id' => $this->primaryKey(),
            'name_answer' => $this->string(255)->notNull(),
            'bool' => $this->boolean()->defaultValue(false)->notNull(),
            'question_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `question_id`
        $this->createIndex(
            'idx-question_answers-question_id',
            'question_answers',
            'question_id'
        );

        // add foreign key for table `questions`
        $this->addForeignKey(
            'fk-question_answers-question_id',
            'question_answers',
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
        // drops foreign key for table `questions`
        $this->dropForeignKey(
            'fk-question_answers-question_id',
            'question_answers'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            'idx-question_answers-question_id',
            'question_answers'
        );

        $this->dropTable('question_answers');
    }
}
