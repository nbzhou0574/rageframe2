<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use common\models\api\AccessToken;
use common\helpers\ResultDataHelper;
use api\controllers\OnAuthController;
use api\modules\v1\models\LoginForm;
use api\modules\v1\models\RefreshForm;
use api\modules\v1\models\MobileLogin;

/**
 * 登录接口
 *
 * Class SiteController
 * @package api\modules\v1\controllers
 * @author jianyan74 <751393839@qq.com>
 */
class SiteController extends OnAuthController
{
    public $modelClass = '';

    /**
     * 不用进行登录验证的方法
     * 例如： ['index', 'update', 'create', 'view', 'delete']
     * 默认全部需要验证
     *
     * @var array
     */
    protected $optional = ['login', 'refresh'];

    /**
     * 登录根据用户信息返回accessToken
     *
     * @return array|bool
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        $model->attributes = Yii::$app->request->post();
        if ($model->validate())
        {
            return AccessToken::getAccessToken($model->getUser(), $model->group);
        }

        // 返回数据验证失败
        return ResultDataHelper::api(422, $this->analyErr($model->getFirstErrors()));
    }

    /**
     * 重置令牌
     *
     * @param $refresh_token
     * @return array
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     */
    public function actionRefresh()
    {
        $model = new RefreshForm();
        $model->attributes = Yii::$app->request->post();
        if (!$model->validate())
        {
            return ResultDataHelper::api(422, $this->analyErr($model->getFirstErrors()));
        }

        return AccessToken::getAccessToken($model->getUser(), $model->group);
    }

    /**
     * 手机验证码登录Demo
     *
     * @return array|mixed
     * @throws \yii\base\Exception
     */
    protected function actionMobileLogin()
    {
        $model = new MobileLogin();
        $model->attributes = Yii::$app->request->post();
        if ($model->validate())
        {
            return AccessToken::getAccessToken($model->getUser(), $model->group);
        }

        // 返回数据验证失败
        return ResultDataHelper::api(422, $this->analyErr($model->getFirstErrors()));
    }

    /**
     * 权限验证
     *
     * @param string $action 当前的方法
     * @param null $model 当前的模型类
     * @param array $params $_GET变量
     * @throws \yii\web\BadRequestHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        // 方法名称
        if (in_array($action, ['index', 'view', 'update', 'create', 'delete']))
        {
            throw new \yii\web\BadRequestHttpException('权限不足');
        }
    }
}
