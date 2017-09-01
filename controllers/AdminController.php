<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ApiAcceptLog;
use yii\data\Pagination;



class AdminController extends Controller
{

	protected $api_accept_model;

	public function init()
	{
		$this->api_accept_model = ApiAcceptLog::find();
	}

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
			//行为，每次请求的时候都调用行为
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		
		//查询所有数据
		$count = ApiAcceptLog::find()->count();
	
		// 使用总数来创建一个分页对象
		$pagination = new Pagination(['totalCount' => $count]);

		$list = $this->api_accept_model->offset($pagination->offset)
						->orderBy('id desc')
						->limit($pagination->limit)
						->all();
		
		if(!empty($list)){

			$arr = array();
			foreach($list as $k=>$v){
				$arr[$v->id] = $v->attributes;
			}
			
			foreach($arr as $k=>$v){
				$arr[$k]['url'] = Yii::$app->urlManager->createUrl(['admin/display-content', 'id' => $v['id']]);
				if(strpos($v['info'], 'Android')){
					$arr[$k]['type'] = '安卓';
				}else if(strpos($v['info'], 'iPhone')){
					$arr[$k]['type'] = '苹果';
				}else{
					$arr[$k]['type'] = '电脑发送';
				}
			}
			
		}
	
		

		return $this->render('Index', [
            'list' => $arr,
			'page' => $pagination,
        ]);
    }

	public function actionDisplayContent()
	{
		$request = Yii::$app->request;
		$type    = $request->get('type');
		$id      = $request->get('id');
		
		

		
		$rc = $this->api_accept_model->where(['id'=>$id])->one();
		if(empty($rc)){
			exit('空数据');
		}

		if($type == '1'){
			$result = 'request_url';
		}else if($type == '2'){
			$result = 'request_param';
		}else if($type == '3'){
			$result = 'response_param';
		}else if($type == '4'){
			$result = 'info';
		}
		
		return $this->renderPartial('DisplayContent', [
            'info' => $rc,
			'result'=>$result,
        ]);

	}


    
}
