<?php

echo "<?php\n";
?>
namespace addons\<?= $model->name;?>\<?= $appID ?>\assets;

use yii\web\AssetBundle;

/**
 * 静态资源管理
 *
 * Class Asset
 * @package addons\<?= $model->name;?>\<?= $appID ?>\assets
 */
class Asset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@addons/<?= $model->name;?>/resources/<?= $appID ?>/';

    public $css = [

    ];

    public $js = [

    ];

    public $depends = [

    ];
}