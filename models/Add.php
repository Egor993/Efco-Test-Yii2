<?php

namespace app\models;

use yii\base\Model;

class Add extends Model {

    public $start;
    public $end;
    public $user_name;
    public $fio;
    public $post;
    public $fixed;

    public function rules(){
        
        return [
            [['start', 'end'], 'required', 'message' => 'Поле не заполнено'],
            ['start',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', 'message' => 'Неправильный формат даты'],
            ['end',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', 'message' => 'Неправильный формат даты']
        ];
    }

    public function AddVac($user) {
        $vac = new Data;
        $vac->start_vacation = $this->start;
        $vac->end_vacation = $this->end;
        $vac->user_name = $this->user_name;
        $vac->fio = $this->fio;
        $vac->post = $this->post;
        $vac->fixed = Null;
        return $vac->save();
    }

}