<?php

use yii\db\Migration;

/**
 * Handles the creation of table `questions`.
 * Has foreign keys to the tables:
 *
 * - `subject`
 * - `user`
 */
class m180130_131313_create_questions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('questions', [
            'id' => $this->primaryKey(),
            'name_question' => $this->string(255)->notNull()->unique(),
            'subject_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(4)->notNull(),
            'type' => $this->string(35)->defaultValue('Стандартный')->notNull(),
            'rating' => $this->integer(3)->notNull(),
            'time' => $this->time()->notNull(),
            'create_date' => $this->dateTime(),
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-questions-subject_id',
            'questions',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-questions-subject_id',
            'questions',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-questions-user_id',
            'questions',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-questions-user_id',
            'questions',
            'user_id',
            'user',
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
            'fk-questions-subject_id',
            'questions'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-questions-subject_id',
            'questions'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-questions-user_id',
            'questions'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-questions-user_id',
            'questions'
        );

        $this->dropTable('questions');
    }
}
