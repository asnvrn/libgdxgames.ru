<?php

namespace app\components;

use yii\behaviors\TimestampBehavior;
use yii\db\BaseActiveRecord;

class MyTimestampBehavior extends TimestampBehavior
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => $this->createdAtAttribute,
            ];
        }
    }
}