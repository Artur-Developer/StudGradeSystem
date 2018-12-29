<?php

use yii\db\Migration;

/**
 * Handles the creation of table `themes`.
 * Has foreign keys to the tables:
 *
 * - `subject`
 * - `user`
 */
class m180130_125105_create_themes_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('themes', [
            'id' => $this->primaryKey(),
            'name_theme' => $this->string(255)->notNull()->unique(),
            'subject_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'create_date' => $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-rating_data-theme_id',
            'rating_data',
            'theme_id'
        );

        $this->addForeignKey(
            'fk-rating_data-theme_id',
            'rating_data',
            'theme_id',
            'themes',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-themes-subject_id',
            'themes',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-themes-subject_id',
            'themes',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-themes-user_id',
            'themes',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-themes-user_id',
            'themes',
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

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-themes-subject_id',
            'themes'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-themes-subject_id',
            'themes'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-themes-user_id',
            'themes'
        );

//        // drops index for column `user_id`
        $this->dropIndex(
            'idx-themes-user_id',
            'themes'
        );


        $this->dropForeignKey(
            'fk-rating_data-theme_id',
            'rating_data'
        );

        $this->dropIndex(
            'idx-rating_data-theme_id',
            'rating_data'
        );


        $this->dropTable('themes');
    }
}
