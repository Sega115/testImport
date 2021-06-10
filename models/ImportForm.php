<?php


namespace app\models;


use yii\base\Model;

class ImportForm extends Model
{

    public $fileName;

    public function rules()
    {
        return[
            [ ['fileName'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx']
        ];
    }

    public function attributeLabels()
    {
        return [
            'fileName' => 'Файлик'
        ];
    }

}