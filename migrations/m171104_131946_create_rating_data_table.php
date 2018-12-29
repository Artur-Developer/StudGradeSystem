<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating_data`.
 */
class m171104_131946_create_rating_data_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('rating_data', [
            'id' => $this->primaryKey(),
            'data' => $this->date(),
            'theme_id' => $this->integer()->defaultValue(null),
        ]);

    }

    /**
     * @inheritdoc
     */

    public function safeDown()
    {
        $this->dropTable('rating_data');
    }
}
