<?php
/**
 * Date: 10/23/19
 * Time: 4:32 PM
 */

namespace frontend\controllers;


use yii\web\Controller;

class MusicDashboardController extends Controller
{
    public function rules()
    {
        
    }

    public function actionIndex()
    {
        return $this->render('index');
    }


}