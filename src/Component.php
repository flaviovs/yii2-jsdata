<?php

namespace fv\yii2\jsdata;

use yii\web\View;

class Component extends \yii\base\Object
{
    public $varName;

    public $encodeOptions = 0;

    public $data = [];


    protected function register(View $view)
    {
        $js = 'var '
            . $this->varName . ' = '
            . \yii\helpers\Json::encode(
                $this->data,
                $this->encodeOptions | JSON_FORCE_OBJECT
            ) . ';';
        $view->registerJs($js, View::POS_HEAD, __CLASS__);
    }


    public function init()
    {
        parent::init();

        if (!$this->varName) {
            $this->varName = 'appData';
        }

        if ($this->encodeOptions) {
            // Make sure we always escape slashes and Unicode, otherwise some
            // characters might end up in JS strings which can cause problems
            // with SCRIPT tags (for example, a string containing
            // "</script>").
            $this->encodeOptions &= ~(JSON_UNESCAPED_UNICODE
                                      | JSON_UNESCAPED_SLASHES);
        }

        \Yii::$app->view->on(
            View::EVENT_END_PAGE,
            function(\yii\base\Event $event) {
                $this->register($event->sender);
            }
        );
    }
}
