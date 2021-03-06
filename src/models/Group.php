<?php

namespace vavepl\portfolio\models;

use luya\admin\traits\SortableTrait;
use Yii;
use luya\admin\ngrest\base\NgRestModel;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Group.
 * 
 * File has been created with `crud/create` command on LUYA version 1.0.0. 
 *
 * @property integer $id
 * @property string $group_name
 * @property string $slug
 * @property smallint $is_active
 * @property integer $priority
 */
class Group extends NgRestModel
{
    use SortableTrait;
    /**
     * @inheritdoc
     */
    public $i18n = ['group_name', 'slug'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio_group';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-portfolio-group';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_name' => Yii::t('app', 'Nom'),
            'slug' => Yii::t('app', 'Lien'),
            'is_active' => Yii::t('app', 'Actif'),
            'priority' => Yii::t('app', 'Priorité'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_active', 'priority'], 'integer'],
            [['group_name', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['group_name'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'group_name' => 'text',
            'slug' => ['slug', 'listener' => 'group_name'],
            'is_active' => ['toggleStatus', 'initValue' => 0],
            'priority' => 'sortable',
        ];
    }

    /**
     * @return string
     */
    public static function sortableField(){
        return 'priority';
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['group_name', 'is_active', 'priority']],
            [['create', 'update'], ['group_name', 'slug', 'is_active', 'priority']],
            ['delete', false],
        ];
    }

    /**
     * @return array
     */
    public static function getMenu(){
        return ArrayHelper::map(self::find()->where(['is_active' => 1])->all(), 'id', 'group_name');
    }

    public function getItems(){
        return $this->hasMany(Item::class, ['group_id' => 'id']);
    }

    /**
     *
     * @return string
     */
    public function getViewUrl()
    {
        return Url::toRoute(['/portfolio/default/group', 'slug' => $this->slug]);
    }
}