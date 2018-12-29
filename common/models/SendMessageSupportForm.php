<?php
/**
 * Created by PhpStorm.
 * User: vipma
 * Date: 26.12.2018
 * Time: 21:47
 */

namespace common\models;


use backend\components\Customs;
use yii\base\Model;
use Yii;
use yii\helpers\Url;
use yii\httpclient\Client;

class SendMessageSupportForm extends Model
{
    public $key_message= 'gtgtgt555';
//    public $public_key = ;
//    public $project_name = Yii::$app->getBaseUrl();

    public $message;
    public $path_error;
    public $URL_support = 'http://supportsgs.com:8080/api/web/site/auth-addressed';

    public function rules()
    {
        return [
            [['message'], 'string', 'max' => 255],
            [['message'], 'required'],

        ];
    }
    public function attributeLabels()
    {
        return [
            'message' => 'Сообщение',
        ];
    }

    public function SendMessageError($FIO,$key_user,$type_addressed)
    {

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl($this->URL_support)
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'project_name'=>Customs::GetProjectName(),
                'public_key'=>Yii::$app->getSecurity()->generatePasswordHash('123123123'),
                'key_user'=>$key_user,
                'key_message'=>$this->key_message,
                'type_message'=>'0',
                'type_addressed'=>$type_addressed,
                'fio_addressed'=>$FIO,
                'message' => $this->message,
                'path_error' => Yii::$app->getHomeUrl()
            ])
            ->send();
        if ($response->isOk) {
            return $response;
        }
    }

}