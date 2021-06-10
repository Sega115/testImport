<?php

namespace app\models;

use DateTime;
use Yii;

/**
 * This is the model class for table "import".
 *
 * @property int $id
 * @property string $date
 *
 * @property Importitem[] $importitems
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * @var DateTime
     */
    private $dateFmt;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'import';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
        ];
    }


    public function setImportItems(array $data) : self
    {
        /** @var Importitem  $datum*/
        foreach ($data as $datum){
            $datum->link('import', $this);
        }
        return  $this;
    }

    public function getDateFmt($format = null){
        if (!$this->dateFmt){
            $this->dateFmt = new DateTime($this->date);
        }
        if (!$format){
            return clone $this->dateFmt;
        }
        return $this->dateFmt->format($format);
    }

    /**
     * Gets query for [[Importitems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImportitems()
    {
        return $this->hasMany(Importitem::className(), ['importId' => 'id'])
            ->inverseOf('import');
    }
}
