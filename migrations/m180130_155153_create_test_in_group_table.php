<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test_in_group`.
 * Has foreign keys to the tables:
 *
 * - `testing`
 * - `subject_group`
 * - `rating_data`
 * - `user`
 */
class m180130_155153_create_test_in_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('test_in_group', [
            'id' => $this->primaryKey(),
            'required' => $this->boolean()->defaultValue(true)->notNull(),
            'type' => $this->string(25)->notNull(),
            'test_id' => $this->integer()->notNull(),
            'subject_group_id' => $this->integer()->notNull(),
            'rating_data_id' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
            'start_date' => $this->dateTime()->notNull(),
            'end_date' => $this->dateTime()->notNull(),
            'create_date' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `test_id`
        $this->createIndex(
            'idx-test_in_group-test_id',
            'test_in_group',
            'test_id'
        );

        // add foreign key for table `testing`
        $this->addForeignKey(
            'fk-test_in_group-test_id',
            'test_in_group',
            'test_id',
            'testing',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_group_id`
        $this->createIndex(
            'idx-test_in_group-subject_group_id',
            'test_in_group',
            'subject_group_id'
        );

        // add foreign key for table `subject_group`
        $this->addForeignKey(
            'fk-test_in_group-subject_group_id',
            'test_in_group',
            'subject_group_id',
            'subject_group',
            'id',
            'CASCADE'
        );

        // creates index for column `rating_data_id`
        $this->createIndex(
            'idx-test_in_group-rating_data_id',
            'test_in_group',
            'rating_data_id'
        );

        // add foreign key for table `rating_data`
        $this->addForeignKey(
            'fk-test_in_group-rating_data_id',
            'test_in_group',
            'rating_data_id',
            'rating_data',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-test_in_group-user_id',
            'test_in_group',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-test_in_group-user_id',
            'test_in_group',
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
        // drops foreign key for table `testing`
        $this->dropForeignKey(
            'fk-test_in_group-test_id',
            'test_in_group'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-test_in_group-test_id',
            'test_in_group'
        );

        // drops foreign key for table `subject_group`
        $this->dropForeignKey(
            'fk-test_in_group-subject_group_id',
            'test_in_group'
        );

        // drops index for column `subject_group_id`
        $this->dropIndex(
            'idx-test_in_group-subject_group_id',
            'test_in_group'
        );

        // drops foreign key for table `rating_data`
        $this->dropForeignKey(
            'fk-test_in_group-rating_data_id',
            'test_in_group'
        );

        // drops index for column `rating_data_id`
        $this->dropIndex(
            'idx-test_in_group-rating_data_id',
            'test_in_group'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-test_in_group-user_id',
            'test_in_group'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-test_in_group-user_id',
            'test_in_group'
        );

        $this->dropTable('test_in_group');
    }
}
