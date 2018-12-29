<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 * Has foreign keys to the tables:
 *
 * - `students`
 * - `rating_data`
 * - `subject_group`
 */
class m171104_131956_create_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(8)->notNull(),
            'col_rating_id' => $this->integer(8)->notNull(),
            'rating' => $this->string(1),
            'subject_group_id' => $this->integer(6)->notNull(),
        ]);

        // creates index for column `student_id`
        $this->createIndex(
            'idx-rating-student_id',
            'rating',
            'student_id'
        );

        // add foreign key for table `students`
        $this->addForeignKey(
            'fk-rating-student_id',
            'rating',
            'student_id',
            'students',
            'id',
            'CASCADE'
        );

        // creates index for column `col_rating_id`
        $this->createIndex(
            'idx-rating-col_rating_id',
            'rating',
            'col_rating_id'
        );

        // add foreign key for table `rating_data`
        $this->addForeignKey(
            'fk-rating-col_rating_id',
            'rating',
            'col_rating_id',
            'rating_data',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_group_id`
        $this->createIndex(
            'idx-rating-subject_group_id',
            'rating',
            'subject_group_id'
        );

        // add foreign key for table `subject_group`
        $this->addForeignKey(
            'fk-rating-subject_group_id',
            'rating',
            'subject_group_id',
            'subject_group',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `students`
        $this->dropForeignKey(
            'fk-rating-student_id',
            'rating'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-rating-student_id',
            'rating'
        );

        // drops foreign key for table `rating_data`
        $this->dropForeignKey(
            'fk-rating-col_rating_id',
            'rating'
        );

        // drops index for column `col_rating_id`
        $this->dropIndex(
            'idx-rating-col_rating_id',
            'rating'
        );

        // drops foreign key for table `subject_group`
        $this->dropForeignKey(
            'fk-rating-subject_group_id',
            'rating'
        );

        // drops index for column `subject_group_id`
        $this->dropIndex(
            'idx-rating-subject_group_id',
            'rating'
        );

        $this->dropTable('rating');
    }
}
