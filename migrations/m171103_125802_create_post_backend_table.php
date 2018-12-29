<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_backend`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m171103_125802_create_post_backend_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('post_backend', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'how_send' => $this->integer(1)->defaultValue(1),
            'user_id' => $this->integer(6)->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post_backend-user_id',
            'post_backend',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post_backend-user_id',
            'post_backend',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post_backend-user_id',
            'post_backend'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-post_backend-user_id',
            'post_backend'
        );

        $this->dropTable('post_backend');
    }
}
