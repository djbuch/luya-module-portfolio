<?php

use yii\db\Migration;

/**
 * Class m181023_102400_portfolio_migrate_4
 */
class m181023_102400_portfolio_migrate_4 extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('portfolio_item', 'link', $this->text());

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
