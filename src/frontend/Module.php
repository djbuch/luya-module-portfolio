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
     * @var array
     */
    public $urlRules = [
        ['pattern' => 'portfolio/<group>/<slug>', 'route' => 'portfolio/default/view'],
        ['pattern' => 'portfolio/<group>/', 'route' => 'portfolio/default/detail'],
    ];
}