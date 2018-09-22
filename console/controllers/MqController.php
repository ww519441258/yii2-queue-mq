<?php
namespace console\controllers;
use common\jobs\EmailJob;
use common\models\User;
use yii\queue\Queue;

/**
 * Class JobController
 * @package console\controllers
 */
class MqController extends BaseController
{

    /**
     * 添加任务
     */
    public function actionIndex(){
        $queue = \Yii::$app->queue;
        $users = User::find()->all();
        foreach ($users as $user){
            $config = [
                'view' => 'mqTest',
                'viewParams' => [
                    'username' => explode('@', $user->email)[0],
                ],
                'from' => \Yii::$app->components['mailer']['transport']['username'],
                'to' => $user->email,
                'subject' => '测试邮件',
            ];
            $jobID = $queue->push(new EmailJob($config));
            $this->log($jobID);
        }
    }

    /**
     * 查询任务
     *
     * @param $jobID
     */
    public function actionStatus($jobID){
        $queue = \Yii::$app->queue;
        $statusLabel = ['', '等待执行', '正在执行', '已执行'];
        while (true){
            $status = $queue->status($jobID);
            $this->log('Job ['.$jobID.'] 当前状态:'.$statusLabel[$status]);
            if($status == Queue::STATUS_DONE){
                break;
            }
            sleep(1);
        }
    }
}