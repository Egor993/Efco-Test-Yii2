<?php

namespace app\models;

use yii\base\Model;

class Change extends Model {

    public $start;
    public $end;

    public function rules(){
        
        return [
            [['start','end'], 'required', 'message' => 'Поле не заполнено'],
            ['start',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', 'message' => 'Неправильный формат даты'],
            ['end',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', 'message' => 'Неправильный формат даты']
        ];
    }

    public function ChangeVac($id) {
        $vac = Data::findOne(['id'=>$id]);
        $vac->start_vacation = $this->start;
        $vac->end_vacation = $this->end;
        return $vac->save();
    }

}