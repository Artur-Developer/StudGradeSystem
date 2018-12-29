<?php

use yii\db\Migration;

/**
 * Handles the creation of table `timetable`.
 * Has foreign keys to the tables:
 *
 * - `all_group`
 * - `subject`
 * - `auditories`
 */
class m180130_120935_create_timetable_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('timetable', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->defaultValue(null),
            'auditoriy_id' => $this->integer()->notNull(),
            'number_lesson' => $this->integer(),
            'type_week' => $this->integer(1)->defaultValue(0),
            'day_week' => $this->integer(1)->defaultValue(null),
            'type_day' => $this->integer(1)->defaultValue(0),
            'save_time' => $this->dateTime(),
            'description' => $this->string(255),
        ]);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-timetable-group_id',
            'timetable',
            'group_id'
        );

        // add foreign key for table `all_group`
        $this->addForeignKey(
            'fk-timetable-group_id',
            'timetable',
            'group_id',
            'all_group',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-timetable-subject_id',
            'timetable',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-timetable-subject_id',
            'timetable',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `auditoriy_id`
        $this->createIndex(
            'idx-timetable-auditoriy_id',
            'timetable',
            'auditoriy_id'
        );

        // add foreign key for table `auditories`
        $this->addForeignKey(
            'fk-timetable-auditoriy_id',
            'timetable',
            'auditoriy_id',
            'auditories',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `all_group`
        $this->dropForeignKey(
            'fk-timetable-group_id',
            'timetable'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-timetable-group_id',
            'timetable'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-timetable-subject_id',
            'timetable'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-timetable-subject_id',
            'timetable'
        );

        // drops foreign key for table `auditories`
        $this->dropForeignKey(
            'fk-timetable-auditoriy_id',
            'timetable'
        );

        // drops index for column `auditoriy_id`
        $this->dropIndex(
            'idx-timetable-auditoriy_id',
            'timetable'
        );

        $this->dropTable('timetable');
    }
}
