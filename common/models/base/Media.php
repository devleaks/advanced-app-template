<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property integer $id
 * @property string $name
 * @property integer $size
 * @property string $type
 * @property integer $related_id
 * @property string $related_class
 * @property string $related_attribute
 * @property string $name_hash
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['size', 'related_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'type'], 'string', 'max' => 80],
            [['related_class', 'related_attribute'], 'string', 'max' => 160],
            [['name_hash'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'size' => Yii::t('app', 'Size'),
            'type' => Yii::t('app', 'Type'),
            'related_id' => Yii::t('app', 'Related ID'),
            'related_class' => Yii::t('app', 'Related Class'),
            'related_attribute' => Yii::t('app', 'Related Attribute'),
            'name_hash' => Yii::t('app', 'Name Hash'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
