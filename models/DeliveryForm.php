<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Delivery;

/**
 * модель формы отправки 
 * здесь происходят основные расчеты
 * 
 */
class DeliveryForm extends Model
{
 public $id_delivery;
 public $id_sourceKladr;
 public $id_targetKladr;
 public $weight;
 public $price;
 public $id_type;
 public $id_status;
 public $updated_at;
 public $created_at;
 public $id_user;
 public $id_carrier;
 public $id_coefficeint ;
 public $basePrice;
 public $comment;
    /**
     * 
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
        [['id_delivery','id_sourceKladr','id_targetKladr','weight',
        'price','id_type','id_status','updated_at','created_at',
        'id_user','id_carrier','id_coefficeint','basePrice','comment'], 'safe'],
        [['weight'],'double'], 
        
         [['comment'], 'string', 'max' => 512],                  
            
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
             'id_delivery'=>'id',
             'id_sourceKladr'=>'id-Откуда',
             'id_targetKladr'=>'id-Куда',
             'weight'=>'Вес',
             'price'=>'Цена',
             'id_type'=>'id-Тип доставки',
             'id_status'=>'id-Статус',
             'updated_at'=>'Дата отправки',
             'created_at'=>'Дата создания',
             'id_user'=>'id-Кто отправил',
             'id_carrier'=>'id-Перевозчик',
             'id_coefficeint'=>'id-Коэффициент',
             'comment'=>'Комментарий',
        ];
    }

    //--------------------------------------------------------------------------    
    public function checkStatus()
    {
        
        $this->id_status=0;
        if(!isset($this->id_sourceKladr))   return;
        if(!isset($this->id_targetKladr))   return;
        if(!isset($this->weight))           return;
        if(!isset($this->price))            return;
        if(!isset($this->id_type))          return;
        if(!isset($this->updated_at))       return;
        if(!isset($this->id_carrier))       return;
        $this->id_status=1;        
        
    }         
            
    public function appendDelivery()
    {
        $record =  new Delivery();
        if(empty($record))return false;
        
        
        $record->id_sourceKladr=$this->id_sourceKladr;
        $record->id_targetKladr=$this->id_targetKladr;
        $record->weight=$this->weight;
        $record->price=$this->price;
        $record->id_type=$this->id_type;
        $record->id_status=$this->id_status;
        $record->updated_at=$this->updated_at;
//        $record->created_at=$this->created_at;
        $record->id_user=$this->id_user;
        $record->id_carrier=$this->id_carrier;
        
        $record->id_coefficeint =$this->id_coefficeint;
        $this->checkStatus();        
        $record->id_status=$this->id_status;
        $record->id_user=1;
        $record->comment =$this->comment;
                
                
        return $record->Save(false);
    }
    //--------------------------------------------------------------------------
    public function deleteDelivery($id)
    {
        if($id==NULL)return false;
        Delivery::DeleteAll(['id_delivery'=>$id]);
    }
    //--------------------------------------------------------------------------
    
    public function getPriceFromCarrier()
    {            
    /*
     * Цена доставки первозчика должна выбираться из соответсвующей таблиы по
     * параметру id_carrier.
     * В тестовой задаче этой табл. нет.
     * Стоит заглушка
     */    
        $this->basePrice=150;
        $this->price=150;
           switch ($this->id_carrier){
               case 0:
                   $this->price=170;
                   break;
               case 1:
                   $this->price=130;
                   break;
               case 2:
                   $this->price=120;
                   break;
               case 3:
                   $this->price=140;
                   break;
               case 4:
                   $this->price=110;
                   break;
               
           }
    }    
    //--------------------------------------------------------------------------
     public function Calc($res=null)
    {
    $this->getPriceFromCarrier();
    
    
        if ($this->id_type==0) //тип доставки= быстрая или меделенная
        {

            if (date("H") > 18) $this->comment="Уже поздно, заказ быстрой доставкой до 18-00";
            else {
                $this->comment='Стоимость доставки: ' . $this->price . "\n";
                $dateTo = floor((strtotime($this->updated_at) - (strtotime('now'))) / (60 * 60 * 24)); 
                $this->comment.='Период доставки, дней: ' . $dateTo . "\n";
            }
        }
       else
       {
            $NewPrice = $this->price*$this->basePrice/$this->price; //Как вариант для определения коэффициента
            $this->comment='Стоимость доставки: '. $NewPrice. "\n".           
                            'Дата доставки: '. $this->updated_at . "\n"; 
           $this->price=$NewPrice;
       }
       
    $this->appendDelivery();

    }
    //-------------------------------------------------------------------------
    
}
       
    

