<?php

use yii\db\Migration;
use \yii\db\Schema;

/**
 * Class m210609_150225_create_news_tables
 */
class m210609_150225_create_news_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('import', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull()
        ]);

        $this->createTable('importItem', [
            'id' => $this->primaryKey(),
            'city' => $this->string(255)->notNull(),
            'latitude' => $this->float()->notNull(),
            'longitude' => $this->float()->notNull(),
            'lighting' => $this->boolean()->defaultValue(1),
            'size' => $this->string(25)->notNull(),
            'sideType' => $this->string(2)->notNull(),
            'side' => $this->string(10)->notNull(),
            'priceType' => $this->string(50),
            'placementPrice' => $this->float()->notNull(),
            'ndsType' => $this->string(50)->notNull(),
            'period' => $this->string()->notNull(),
            'impressionsPerDay' => $this->integer()->notNull(),
            'importId' => $this->integer()->notNull()
        ]);

        $this->createIndex('importItem_importID', 'importItem' , 'importId');

        $this->addForeignKey('importItem_importID', 'importItem' , 'importId',
            'import', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        echo "m210609_150225_create_news_tables cannot be reverted.\n";
        $this->dropForeignKey('importItem_importID', 'importItem');
        $this->dropTable('import');
        $this->dropTable('importItem');
    }
}
