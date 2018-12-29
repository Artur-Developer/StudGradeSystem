<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subject_group`.
 * Has foreign keys to the tables:
 *
 * - `all_group`
 * - `subject`
 * - `user`
 */
class m171103_173803_create_subject_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('subject_group', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(11)->notNull(),
            'subject_id' => $this->integer(11)->notNull(),
            'group_created_data' => $this->dateTime()->notNull(),
            'status' => 'ENUM("active", "inactive")',
            'user_id' => $this->integer(4)->notNull(),
        ]);
		$sql = "ALTER TABLE subject_group ALTER status SET DEFAULT 'active'";
        $this->execute($sql);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-subject_group-group_id',
            'subject_group',
            'group_id'
        );

        // add foreign key for table `all_group`
        $this->addForeignKey(
            'fk-subject_group-group_id',
            'subject_group',
            'group_id',
            'all_group',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-subject_group-subject_id',
            'subject_group',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-subject_group-subject_id',
            'subject_group',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-subject_group-user_id',
            'subject_group',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-subject_group-user_id',
            'subject_group',
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
        // drops foreign key for table `all_group`
        $this->dropForeignKey(
            'fk-subject_group-group_id',
            'subject_group'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-subject_group-group_id',
            'subject_group'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-subject_group-subject_id',
            'subject_group'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-subject_group-subject_id',
            'subject_group'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-subject_group-user_id',
            'subject_group'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-subject_group-user_id',
            'subject_group'
        );

        $this->dropTable('subject_group');
    }
}
