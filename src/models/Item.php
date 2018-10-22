<?php

namespace vavepl\portfolio\models;

use luya\admin\traits\SortableTrait;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Item.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0. 
 *
 * @property integer $id
 * @property integer $group_id
 * @property string $name
 * @property string $company
 * @property string $company_address
 * @property string $company_postcode
 * @property string $company_city
 * @property string $company_country
 * @property string $company_sector
 * @property integer $company_logo_id
 * @property string $description
 * @property string $short_description
 * @property string $technologies
 * @property string $color
 * @property string $link
 * @property integer $main_img_id
 * @property array $other_img_id
 * @property smallint $is_active
 * @property integer $priority
 */
class Item extends NgRestModel
{
    use SortableTrait;

    /**
     * @inheritdoc
     */
    public $i18n = ['name', 'description', 'short_description','technologies', 'color', 'link'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio_item';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-portfolio-item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Description courte'),
            'technologies' => Yii::t('app', 'Technologies'),
            'color' => Yii::t('app', 'Color'),
            'link' => Yii::t('app', 'Link'),
            'main_img_id' => Yii::t('app', 'Image principale'),
            'company_logo_id' => Yii::t('app', 'Logo société'),
            'is_active' => Yii::t('app', 'Is Active'),
            'priority' => Yii::t('app', 'Priority'),
        ];



    }

    /**
     * @return string
     */
    public static function sortableField()
    {
        return 'priority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'main_img_id', 'company_logo_id', 'is_active', 'priority'], 'integer'],
            [['name', 'color', 'link', 'company', 'company_address', 'company_postcode', 'company_city', 'company_country', 'company_sector'], 'string', 'max' => 255],
            [['description', 'short_description'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['name', 'description', 'color', 'link'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'group_id' => [
                'selectModel',
                'modelClass' => Group::className(),
                'valueField' => 'id',
                'labelField' => 'group_name'
            ],
            'name' => 'text',
            'description' => 'text',
            'short_description' => 'text',
            'color' => 'color',
            'link' => 'text',
            'main_img_id' => 'image',
            'company_logo_id' => 'image',
            'is_active' => ['toggleStatus', 'initValue' => 0],
            'priority' => 'sortable',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['group_id', 'name', 'description', 'color', 'link', 'main_img_id', 'company_logo_id', 'is_active', 'priority']],
            [['create', 'update'], ['group_id', 'name', 'company', 'company_address', 'company_postcode', 'company_city', 'company_country', 'company_sector', 'description', 'color', 'link', 'main_img_id', 'company_logo_id', 'is_active', 'priority']],
            ['delete', false],
        ];
    }

    public static function getElements(){
        $elements = self::find()->where(['is_active' => 1])->all();
        $data = [];
        foreach ($elements as $key=>$element) {
            $data[$key] = $element;
            $data[$key]['img_min_id'] = \Yii::$app->storage->getImage($element['img_min_id']);
            $data[$key]['img_max_id'] = \Yii::$app->storage->getImage($element['img_max_id']);
        }
        return $data;
    }

    public function getGroup(){
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

}