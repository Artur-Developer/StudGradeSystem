<?php

use yii\db\Migration;

/**
 * Handles the creation of table `result_testing`.
 * Has foreign keys to the tables:
 *
 * - `test_in_group`
 */
class m180130_163213_create_result_testing_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('result_testing', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'test_token' => $this->string(255),
            'result' => $this->integer(),
            'comment' => $this->string(255),
        ]);

        // creates index for column `test_id`
        $this->createIndex(
            'idx-result_testing-test_id',
            'result_testing',
            'test_id'
        );

        // add foreign key for table `test_in_group`
        $this->addForeignKey(
            'fk-result_testing-test_id',
            'result_testing',
            'test_id',
            'test_in_group',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-result_testing-student_id',
            'result_testing',
            'student_id'
        );

        // add foreign key for table `students`
        $this->addForeignKey(
            'fk-result_testing-student_id',
            'result_testing',
            'student_id',
            'students',
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
            'fk-result_testing-test_id',
            'result_testing'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-result_testing-test_id',
            'result_testing'
        );

        // drops foreign key for table `students`
        $this->dropForeignKey(
            'fk-result_testing-student_id',
            'result_testing'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-result_testing-student_id',
            'result_testing'
        );

        $this->dropTable('result_testing');
    }
}
