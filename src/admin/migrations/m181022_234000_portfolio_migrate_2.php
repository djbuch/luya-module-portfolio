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
        $this->addColumn('portfolio_item', 'company', $this->string(255));
        $this->addColumn('portfolio_item', 'company_address', $this->string(255));
        $this->addColumn('portfolio_item', 'company_postcode', $this->string(255));
        $this->addColumn('portfolio_item', 'company_city', $this->string(255));
        $this->addColumn('portfolio_item', 'company_country', $this->string(255));
        $this->addColumn('portfolio_item', 'company_sector', $this->string(255));
        $this->addColumn('portfolio_item', 'short_description', $this->text());
        $this->addColumn('portfolio_item', 'technologies', $this->text());
        $this->addColumn('portfolio_item', 'other_img_id', $this->text());

        $this->renameColumn('portfolio_item', 'img_max_id', 'main_img_id');
        $this->renameColumn('portfolio_item', 'img_min_id', 'company_logo_id');

        $this->alterColumn('portfolio_item', 'description', $this->text());

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
    }
}
