<?php
/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\models\Delivery;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
$this->title = 'Delivery';

/*
 * Создание провайдера
 * Не в темсте можно дополнить searchProviderж
 */

$dataProvider = new ActiveDataProvider(
[
    'query' => Delivery::find(),
    'sort' => ['defaultOrder' => ['id_delivery' => SORT_DESC]],
    'key' => 'id_delivery',
    'pagination' => [
    'pageSize' => 100,
    ],
]);



function getStatus($id)
{
/*
 * Здесь должно быть обращение к табл. Status
 */

    
    $status="не определен";
if(!isset($id))return $status;

    switch ($id)
    {        
        case 0:
            $status="ошибка";
                break;
        case 1:
            $status="доставлено";
                break;
        case 2:
            $status="в пути";
                break;
            
    }        
    
  return $status;  
                               
}

function getdeliveryCurrier($id)
{
    $items=getItemsdeliveryCurrier();
    return $items[$id];
}

function getItemsdeliveryCurrier()
{
    /*
     * Здесь должно быть обращение к табл. Curriers
     */

    $items=[
    0=>'Почта',
    1=>'Боксбэрри',
    2=>'Скэд',
    3=>'DHL Express',
    4=>'UPS'];        
return $items;    
}


function getItemsKladr()
{
    $items=[];
    for($i=0;$i<=5;$i++)
    $items[]=getStrKladrById($i);
    
return $items;    
}



function getdeliveryType($id)
{
    $items=getItemsdeliveryType();
    return  $items[$id];
}    
    
    


function getItemsdeliveryType()
{

    $items=[0=>'Быстрая'
            ,1=>'Медленная'];
    
    
    
return $items;    
}

function getStrKladrById($id)
{
    /*
     * Здесь должно быть обращение к табл. Кладр
     */
    
    $retS="ул. Непонятная ".$id;
    switch ($id){
                case 0:
                    $retS = 'Советская д. 06';
                    break;
                case 1:
                    $retS = 'Мичурина д. 1';
                    break;
                case 2:
                    $retS = 'Краснодарская д. 321';
                    break;
                case 3:
                    $retS = 'Волгоградская д. 67';
                    break;
                case 4:
                    $retS = 'Бекетова д. 31';
                    break;
                
                case 5:
                    $retS = 'Гончарова  д.1, корп 3';
                    break;

            }
    
    return $retS;
}


?>






 <?php $form = ActiveForm::begin([ 
                    'id' => 'delivery']); ?>

<div class="site-index">
    <div class="jumbotron bg-transparent mt-5 mb-5">
        

              
<div class="row">
                <div class = "col-md-2">
                <?= $form->field($model, 'id_sourceKladr')->dropDownList(getItemsKladr())->Label('Откуда'); ?>
                </div>
    
                <div class = "col-md-2">
                <?=  $form->field($model, 'id_targetKladr')->dropDownList(getItemsKladr())->Label('Куда'); ?>
                </div>         
    
                <div class = "col-md-2">
                <?=  $form->field($model, 'weight')->textInput(); ?>
                </div>         
    
    
                
                <div class = "col-md-2">
                <?=  $form->field($model, 'id_type')->dropDownList(getItemsdeliveryType())->Label('Тип'); ?>
                </div>         

                <div class = "col-md-2">
                <?=  $form->field($model, 'id_carrier')->dropDownList(getItemsdeliveryCurrier())->Label('Перевозчик'); ?>
                </div>         
    
                <div class = "col-md-2">
                <?=  $form->field($model, 'updated_at')->textInput(['type' => 'date']); ?>
                </div>         

                <div class="form-group">
                 <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                
</div>           

<?php 


echo GridView::widget([                        
                    'dataProvider' => $dataProvider,

                        'columns'=>
                        [
                         ['label'=>'№',
                          'attribute'=>'id_delivery',   
                         'options' => ['style' =>'width: 39px;']    
                             ],
                            
                         ['label' =>'Откуда',
                          'attribute'=>'id_sourceKladr'
                          ,'format' => 'raw',
                          'value' => function($model)
                             {
                             return getStrKladrById($model->id_sourceKladr);
                            },   
                             
                                  
                         ],                            
          
                         ['label' =>'Куда',
                          'attribute'=>'id_targetKladr',
                          'format' => 'raw',
                          'value' => function($model)
                             {
                             return getStrKladrById($model->id_targetKladr);
                            },   
                             
                                  
                         ],                            
                        ['attribute'=>'comment','label' =>'Комментарий',],                                                                        
                        ['attribute'=>'id_carrier','label' =>'Перевозчик',
                          'format' => 'raw',
                          'value' => function($model)
                             {
                             return getdeliveryCurrier($model->id_carrier);
                            },   
                         ],  
                                    
                                    
                        ['attribute'=>'id_type','label' =>'Тип',
                          'format' => 'raw',
                          'value' => function($model)
                             {
                             return getdeliveryType($model->id_type);
                            },   
                            
                            ],            
                                    
                        ['attribute'=>'weight','label' =>'Вес',],            
                        ['attribute'=>'price','label' =>'Цена',],            
                        ['attribute'=>'id_status','label' =>'статус','options' => ['style' =>'width: 99px;'],
                            'format' => 'raw',
                          'value' => function($model)
                             {
                                return getStatus($model->id_status);
                                },   
                                                      
                            
                            ],
                                    
                        ['attribute'=>'id_user','label' =>'Отправитель','options' => ['style' =>'width: 99px;'],],
                        ['attribute'=>'updated_at','label' =>'Отправлено','options' => ['style' =>'width: 99px;'],],                                    
                        
                             ],                            
                                    
                                    
                        ]);

                
                
                ?>      
        
    
    </div>
</div>

                <?php ActiveForm::end(); ?>