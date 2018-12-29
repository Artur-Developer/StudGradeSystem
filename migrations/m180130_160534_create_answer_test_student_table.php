<?php

use yii\db\Migration;

/**
 * Handles the creation of table `answer_test_student`.
 * Has foreign keys to the tables:
 *
 * - `test_in_group`
 * - `students`
 * - `question_answers`
 */
class m180130_160534_create_answer_test_student_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('answer_test_student', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'question_answers_id' => $this->integer(),
            'question_id' => $this->integer()->notNull(),
            'create_date' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `test_id`
        $this->createIndex(
            'idx-answer_test_student-test_id',
            'answer_test_student',
            'test_id'
        );

        // add foreign key for table `test_in_group`
        $this->addForeignKey(
            'fk-answer_test_student-test_id',
            'answer_test_student',
            'test_id',
            'test_in_group',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-answer_test_student-student_id',
            'answer_test_student',
            'student_id'
        );

        // add foreign key for table `students`
        $this->addForeignKey(
            'fk-answer_test_student-student_id',
            'answer_test_student',
            'student_id',
            'students',
            'id',
            'CASCADE'
        );

        // creates index for column `question_answers_id`
        $this->createIndex(
            'idx-answer_test_student-question_answers_id',
            'answer_test_student',
            'question_answers_id'
        );

        // add foreign key for table `question_answers`
        $this->addForeignKey(
            'fk-answer_test_student-question_answers_id',
            'answer_test_student',
            'question_answers_id',
            'question_answers',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `test_in_group`
        $this->dropForeignKey(
            'fk-answer_test_student-test_id',
            'answer_test_student'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-answer_test_student-test_id',
            'answer_test_student'
        );

        // drops foreign key for table `students`
        $this->dropForeignKey(
            'fk-answer_test_student-student_id',
            'answer_test_student'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-answer_test_student-student_id',
            'answer_test_student'
        );

        // drops foreign key for table `question_answers`
        $this->dropForeignKey(
            'fk-answer_test_student-question_answers_id',
            'answer_test_student'
        );

        // drops index for column `question_answers_id`
        $this->dropIndex(
            'idx-answer_test_student-question_answers_id',
            'answer_test_student'
        );

        $this->dropTable('answer_test_student');
    }
}
