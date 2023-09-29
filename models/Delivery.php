<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;



/**
 * This is the model class for table "delivery".
 *
 * @property integer id_delivery
 * @property integer id_sourceKladr
 * @property integer id_targetKladr
 * @property float weight
 * @property float price
 * @property integer id_type
 * @property integer id_status
 * @property datetime updated_at
 * @property datetime created_at
 * @property integer id_user
 * @property integer id_carrier
 * @property integer id_coefficeint 
 * @property string comment
 * 
 * 
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
 
    return [[['id_delivery','id_sourceKladr','id_targetKladr','weight',
        'price','id_type','id_status','updated_at','created_at',
        'id_user','id_carrier','id_coefficeint','comment'], 'safe'],
        ];
    }
    //--------------------------------------------------------------------------
    /**
     * @inheritdoc
     */
       public function behaviors()
   {

                        return [
                        [
                        'class' => TimestampBehavior::className(),
                        'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],                            
                        ],
                        // если вместо метки времени UNIX используется datetime:
                        'value' => new Expression('NOW()'),
                        ],
                        ];
   } 
   //---------------------------------------------------------------------------
}