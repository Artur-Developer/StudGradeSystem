<?php

use yii\db\Migration;

/**
 * Handles the creation of table `students`.
 * Has foreign keys to the tables:
 *
 * - `all_group`
 */
class m171103_113937_create_students_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('students', [
            'id' => $this->primaryKey(),
            'last_name' => $this->string(50)->notNull(),
            'first_name' => $this->string(50)->notNull(),
            'middle_name' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull(),
            'telegram_id' => $this->string(40),
            'phone' => $this->string(11),
            'password_hash' => $this->string(255)->notNull(),
            'student_token' => $this->string(255)->notNull()->unique(),
            'password_reset_token' => $this->string(255)->unique(),
            'traing' => $this->string(12)->notNull(),
            'group_id' => $this->integer(8)->notNull(),
            'about_me' => $this->string(255),
            'goals' => $this->string(255),
            'create_data' => $this->dateTime(),
            'img' => $this->string(255),
			'status' => 'ENUM("active", "inactive")',
			'status_training' => $this->integer(1)->defaultValue(1)->notNull(),
        ]);
		$sql = "ALTER TABLE students ALTER status SET DEFAULT 'inactive'";
        $this->execute($sql);

        // creates index for column `group_id`
        $this->createIndex(
            'idx-students-group_id',
            'students',
            'group_id'
        );

        // add foreign key for table `all_group`
        $this->addForeignKey(
            'fk-students-group_id',
            'students',
            'group_id',
            'all_group',
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
            'fk-students-group_id',
            'students'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-students-group_id',
            'students'
        );

        $this->dropTable('students');
    }
}
