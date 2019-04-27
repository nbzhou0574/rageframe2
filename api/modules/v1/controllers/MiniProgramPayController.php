<?php
namespace api\modules\v1\controllers;

use Yii;
use common\helpers\UrlHelper;
use common\helpers\PayHelper;
use common\helpers\StringHelper;
use common\helpers\ArrayHelper;
use common\models\common\PayLog;
use common\helpers\ResultDataHelper;
use api\controllers\OnAuthController;

/**
 * 小程序支付案例
 *
 * Class MiniProgramPayController
 * @package api\modules\v1\controllers
 * @author jianyan74 <751393839@qq.com>
 */
class MiniProgramPayController extends OnAuthController
{
    public $modelClass = '';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        // 微信支付参数配置
        Yii::$app->params['wechatPaymentConfig'] = ArrayHelper::merge([
            'app_id' => Yii::$app->debris->config('miniprogram_appid'),
        ], Yii::$app->params['wechatPaymentConfig']);

        parent::init();
    }

    /**
     * 生成微信JSAPI支付的Demo方法 默认禁止外部访问 测试请修改方法类型
     *
     * @return array|mixed|\yii\data\ActiveDataProvider
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $totalFee = 100;// 支付金额单位：分
        $orderSn = time() . StringHelper::randomNum();// 订单号,关联的订单表

        $orderData = [
            'trade_type' => 'JSAPI',
            'body' => '支付简单说明',
            'detail' => '支付详情',
            'notify_url' => UrlHelper::toFront(['notify/mini-program']), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'out_trade_no' => PayHelper::getOutTradeNo($totalFee, $orderSn, PayLog::PAY_TYPE_MINI_PROGRAM), // 支付
            'total_fee' => $totalFee,
            'openid' => '', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
        ];

        $payment = Yii::$app->wechat->payment;
        $result = $payment->order->unify($orderData);
        if ($result['return_code'] == 'SUCCESS')
        {
            return $payment->jssdk->sdkConfig($result['prepay_id']);
        }

        return ResultDataHelper::api(422, $result['return_msg']);
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
        if (in_array($action, ['view', 'update', 'create', 'delete']))
        {
            throw new \yii\web\BadRequestHttpException('权限不足');
        }
    }
}