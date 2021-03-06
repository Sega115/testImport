<?php


namespace app\controllers;


use app\models\Import;
use app\models\ImportForm;
use app\models\Importitem;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Worksheet;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\UploadedFile;

class ImportController extends Controller
{

    public function actionIndex()
    {
        $model = new ImportForm();
        $err = '';
        if (Yii::$app->request->isPost){
            $data = UploadedFile::getInstance($model, 'fileName');
            $excel = PHPExcel_IOFactory::load($data->tempName);
            $activeSheet = $excel->setActiveSheetIndex( 0);

            $modelImport = $this->buildImportModel();
            $modelImport->save();
            $modelImport->setImportItems($this->buildImportItems($activeSheet));
            $modelImport->save();

        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    private function buildImportModel(): Import
    {
        $importModel = new Import();
        $importModel->date = (new \DateTime())->format('Y-m-d H:i:s');
        return  $importModel;
    }

    private function buildImportItems(PHPExcel_Worksheet $worksheet): array
    {
        $result = [];
        $data = $worksheet->toArray();
        $dataQty = count($data);
        if ($dataQty <= 1){
            return $result;
        }
        for ($i = 1; $i< $dataQty; $i++){
            $result[] = $this->buildImportItem($data[$i]);
        }

        return $result;
    }

    private function buildImportItem(array $data) : Importitem
    {
        $model = new Importitem();
        $model->city = $data[0];
        $model->latitude = $data[1];
        $model->longitude = $data[2];
        $model->lighting = $data[3];
        $model->size = $data[4];
        $model->sideType = $data[5];
        $model->side = $data[6];
        $model->priceType = $data[7];
        $model->placementPrice = $data[8];
        $model->ndsType = $data[9];
        $model->period = $data[10];
        $model->impressionsPerDay = $data[11];
        return $model;
    }


    public function actionHistory() :string
    {
        return $this->render('history', [
            'history' => Import::find()->all()
        ]);
    }

    public function actionItem($importID=null): string
    {
        $activeQuery = Importitem::find();
        $title = '?????? ??????????????';
        if ($importID){
            $activeQuery->where('importId=:id', ['id' => $importID]);
            /** @var  $import Import*/
            $import = Import::find()->where('id=:id', ['id' => $importID])->limit(1)->one();
            $title = '???????????? ????: '. $import->getDateFmt('d:m:Y H:i');
        }

        return $this->render('historyImport', [
            'dataProvider' =>  new ActiveDataProvider([
                'query' => $activeQuery
            ]),
            'title' => $title,

        ]);
    }

}