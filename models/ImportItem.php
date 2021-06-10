<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "importitem".
 *
 * @property int $id
 * @property string $city
 * @property float $latitude
 * @property float $longitude
 * @property int|null $lighting
 * @property string $size
 * @property string $sideType
 * @property string $side
 * @property string|null $priceType
 * @property float $placementPrice
 * @property string $ndsType
 * @property string $period
 * @property int $impressionsPerDay
 * @property int $importId
 *
 * @property Import $import
 */
class Importitem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'importitem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'latitude', 'longitude', 'size', 'sideType', 'side', 'placementPrice', 'ndsType', 'period', 'impressionsPerDay', 'importId'], 'required'],
            [['latitude', 'longitude', 'placementPrice'], 'number'],
            [['lighting', 'impressionsPerDay', 'importId'], 'integer'],
            [['city', 'period'], 'string', 'max' => 255],
            [['size'], 'string', 'max' => 25],
            [['sideType'], 'string', 'max' => 2],
            [['side', 'priceType'], 'string', 'max' => 10],
            [['ndsType'], 'string', 'max' => 50],
            [['importId'], 'exist', 'skipOnError' => true, 'targetClass' => Import::className(), 'targetAttribute' => ['importId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'lighting' => 'Lighting',
            'size' => 'Size',
            'sideType' => 'Side Type',
            'side' => 'Side',
            'priceType' => 'Price Type',
            'placementPrice' => 'Placement Price',
            'ndsType' => 'Nds Type',
            'period' => 'Period',
            'impressionsPerDay' => 'Impressions Per Day',
            'importId' => 'Import ID',
        ];
    }

    /**
     * Gets query for [[Import]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImport()
    {
        return $this->hasOne(Import::className(), ['id' => 'importId'])->inverseOf('importitems');
    }
}
