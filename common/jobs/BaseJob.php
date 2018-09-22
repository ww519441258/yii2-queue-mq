<?php

namespace common\jobs;

use common\traits\JobTrait;
use yii\base\BaseObject;
use yii\db\StaleObjectException;
use yii\queue\JobInterface;
use yii\queue\Queue;
use yii\queue\RetryableJobInterface;

/**
 * Class BaseJob
 * @property array $args
 * @package common\jobs
 */
class BaseJob extends BaseObject implements JobInterface, RetryableJobInterface
{

    use JobTrait;

    /**
     * @param Queue $queue which pushed and is handling the job
     */
    public function execute($queue)
    {
    }

    /**
     * 后处理
     */
    public function afterExecute(){
    }

    /**
     * @return int time to reserve in seconds
     */
    public function getTtr()
    {
        return 15 * 60;
    }

    /**
     * @param int $attempt number
     * @param \Exception|\Throwable $error from last execute of the job
     * @return bool
     */
    public function canRetry($attempt, $error)
    {
        return $attempt < 5;
    }
}
