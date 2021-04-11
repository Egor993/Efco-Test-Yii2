<?php

namespace app\models;

use yii\base\Model;

class Approve extends Model {

    public $fixed;

    public function rules(){
        
        return [
            [['start','end'], 'required'],
            ['start',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/'],
            ['end',  'match', 'pattern' => '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/']
        ];
    }

    public function ApproveVac($id) {
        $vac = Data::findOne(['id'=>$id]);
        $vac->fixed = $this->fixed;
        return $vac->save();
    }

}