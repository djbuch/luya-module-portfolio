<?php

use yii\db\Migration;

/**
 * Class m181024_111900_portfolio_migrate_5
 */
class m181024_111900_portfolio_migrate_5 extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('portfolio_item', 'date', $this->integer());

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
