<?php

namespace vavepl\portfolio\frontend\controllers;

use vavepl\portfolio\models\Group;
use vavepl\portfolio\models\Item;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\web\NotFoundHttpException;
use Exception;
use luya\cms\frontend\base\Controller;
use luya\helpers\StringHelper;
use luya\cms\models\Redirect;

class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;

    /**
     * Get Article overview.
     *
     * The index action will return an active data provider object inside the $provider variable:
     *
     * ```php
     * foreach ($provider->models as $item) {
     *     var_dump($item);
     * }
     * ```
     *
     * @return string
     */
    public function actionIndex()
    {
        $provider = new ActiveDataProvider([
            'query' => Item::find()->andWhere(['is_active' => 1]),
            'sort' => [
                'defaultOrder' => $this->module->portfolioDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => ['page' => Yii::$app->request->get('page')],
                'defaultPageSize' => $this->module->portfolioDefaultPageSize,
            ],
        ]);

        return $this->render('index', [
            'model' => Item::class,
            'provider' => $provider,
        ]);
    }


    public function actionGroup($slug)
    {
        $model = Group::find()->i18nWhere('slug', $slug)->one();

        if (!$model) {
            return $this->goHome();
        }

        $provider = new ActiveDataProvider([
            'query' => $model->getItems(),
            'sort' => [
                'defaultOrder' => $this->module->portfolioDefaultOrder,
            ],
            'pagination' => [
                'route' => $this->module->id,
                'params' => ['page' => Yii::$app->request->get('page')],
                'defaultPageSize' => $this->module->portfolioDefaultPageSize,
            ],
        ]);

        return $this->render('group', [
            'model' => $model,
            'provider' => $provider,
        ]);
    }

    public function actionView($slug, $group)
    {
        $item = Item::find()->where(['is_active' => 1])->i18nWhere('slug', $slug)->one();

        return $this->render('view', [
            'item' => $item
        ]);
    }
}
