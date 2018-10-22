<?php

use yii\db\Migration;

/**
 * Class m181023_005300_portfolio_migrate_3
 */
class m181023_005300_portfolio_migrate_3 extends Migration
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
