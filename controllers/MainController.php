<?php

namespace app\controllers;

use app\models\Users;
use app\filters\VkAuth;

class MainController extends Controller
{
	public function behaviors()
	{
		return [
			'authenticator' => [
				'class' => VkAuth::className(),
			]
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}
}