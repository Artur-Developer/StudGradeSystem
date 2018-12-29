<?php

use yii\db\Migration;

/**
 * Handles the creation of table `uploadExelFile`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m171103_125254_create_uploadExcelFile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('uploadExcelFile', [
            'id' => $this->primaryKey(),
            'fileName' => $this->string(100)->notNull()->unique(),
            'fileExtensions' => $this->string(6)->notNull(),
            'importData' => $this->dateTime()->notNull(),
            'user_id' => $this->integer(7)->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-uploadExcelFile-user_id',
            'uploadExcelFile',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-uploadExcelFile-user_id',
            'uploadExcelFile',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-all_group-importFile_id',
            'all_group',
            'importFile_id',
            'uploadExcelFile',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-uploadExcelFile-user_id',
            'uploadExcelFile'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-uploadExcelFile-user_id',
            'uploadExcelFile'
        );

        $this->dropForeignKey(
            'fk-all_group-importFile_id',
            'all_group'
        );




        $this->dropTable('uploadExcelFile');
    }
}
