<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ApiAcceptLog;
use app\models\ApiPushLog;
use app\models\ApiAppUser;
use yii\data\Pagination;



class AdminController extends Controller
{

	protected $api_accept_model;
    protected $api_push_log_model;
	protected $api_app_user_model;

	public function init()
	{
		$this->api_accept_model = ApiAcceptLog::find();
        $this->api_push_log_model = ApiPushLog::find();
		$this->api_app_user_model = ApiAppUser::find();
    
	}

    /**
     * @inheritdoc
     */
   /* public function behaviors()
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
    }*/

    /**
     * @inheritdoc
     */
    /*public function actions()
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
    }*/

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
                $string = json_decode($v['response_param']);
                $arr[$k]['response_param'] = json_encode($string,JSON_UNESCAPED_UNICODE);

			}
		}
        
		return $this->render('Index', [
            'list' => $arr,
			'page' => $pagination,
        ]);
    }


    
    public function actionPushIndex()
    {

        //查询所有数据
		$count = $this->api_push_log_model->count();
        
		// 使用总数来创建一个分页对象
		$pagination = new Pagination(['totalCount' => $count]);

		$list = $this->api_push_log_model->offset($pagination->offset)
						->orderBy('id desc')
						->limit($pagination->limit)
                        ->asArray()
						->all();
	
		if(!empty($list)){
			foreach($list as $k=>$v){
               
                $user_array = '';
                $user = '';
                $display_array = '';
                
                $list[$k]['sender'] = json_encode(json_decode($v['sender'],true),JSON_UNESCAPED_UNICODE);
                $list[$k]['text'] = json_encode(json_decode($v['text'],true),JSON_UNESCAPED_UNICODE);
                $list[$k]['return_info'] = json_encode(json_decode($v['return_info'],true),JSON_UNESCAPED_UNICODE);
                
                if($v['send_port'] == '1'){
                    $list[$k]['type'] = '极光推送';
                }else{
                    $list[$k]['type'] = '友盟推送';
                }
                
                if(!empty($v['user_id'])){
                    $user_array = explode(',',$v['user_id']);
                  
                    foreach($user_array as $kk=>$vv){
                        if(empty($vv)){
                            continue;
                        }
                       
                        $user[] = $this->api_app_user_model->where(['user_id'=>$vv])->select(['user_name'])->asArray()->one()['user_name'];
                        $display_array = implode(',',$user);
                    }
                }

                $list[$k]['display_array'] = $display_array;

			}
		}
        
		return $this->render('PushIndex', [
            'list' => $list,
			'page' => $pagination,
        ]);
    }




    

    
}
