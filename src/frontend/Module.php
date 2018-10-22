<?php

namespace vavepl\portfolio\frontend;

/**
 * Portfolio Admin Module.
 *
 * File has been created with `module/create` command on LUYA version 1.0.0. 
 */
class Module extends \luya\base\Module
{
    public $useAppViewPath = true;

    /**
     * @var array The default order for the article overview in the index action for the news.
     *
     * In order to read more about activeDataProvider defaultOrder: http://www.yiiframework.com/doc-2.0/yii-data-sort.html#$defaultOrder-detail
     */
    public $portfolioDefaultOrder = ['priority' => SORT_DESC];

    /**
     * @var integer Default number of pages.
     */
    public $portfolioDefaultPageSize = 10;

    /**
     * @var array
     */
    public $urlRules = [
        ['pattern' => 'portfolio/<group>/<slug>', 'route' => 'portfolio/default/view'],
        ['pattern' => 'portfolio/<group>/', 'route' => 'portfolio/default/detail'],
    ];
}