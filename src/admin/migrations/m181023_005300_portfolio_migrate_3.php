<?php

use yii\db\Migration;

/**
 * Class m171222_121554_portfolio_migrate
 */
class m181022_234000_portfolio_migrate_2 extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('portfolio_item', 'slug', $this->string(255));
        $this->addColumn('portfolio_group', 'slug', $this->string(255));

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
