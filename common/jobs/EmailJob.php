<?php

namespace common\jobs;

use yii\base\ViewNotFoundException;

/**
 * Class EmailJob
 * @property array $args
 * @package common\jobs
 */
class EmailJob extends BaseJob
{

    public $view, $viewParams, $from, $to, $subject, $body;

    public function execute($queue)
    {
        parent::execute($queue);
        sleep(5);
        $response = \Yii::$app->mailer->compose($this->view, $this->viewParams)
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();
        $this->stdout($response);
    }

    public function getTtr()
    {
        return 15 * 60;
    }

    public function canRetry($attempt, $error)
    {
        $this->stdout($attempt.'---'.$error);
        return ($attempt < 5) && ($error instanceof ViewNotFoundException);
    }
}
