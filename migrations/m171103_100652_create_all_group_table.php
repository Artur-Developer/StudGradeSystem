<?php

use yii\db\Migration;

/**
 * Handles the creation of table `all_group`.
 */
class m171103_100652_create_all_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('all_group', [
            'id' => $this->primaryKey(),
            'name_group' => $this->string(50)->notNull()->unique(),
            //'create_data' => $this->dateTime()->notNull(),
            'importFile_id' => $this->integer(7)->notNull(),
            'status' => 'ENUM("active", "inactive")',
        ]);
        $sql = "ALTER TABLE all_group ALTER status SET DEFAULT 'active'";
        $this->execute($sql);

        $this->createIndex(
            'idx-all_group-importFile_id',
            'all_group',
            'importFile_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-all_group-importFile_id',
            'all_group'
        );

        $this->dropTable('all_group');
    }
}
