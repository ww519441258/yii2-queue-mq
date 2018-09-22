<?php

namespace common\traits;

trait JobTrait{
    /**
     * STDOUT输出
     *
     * @param $msg
     */
    public function stdout($msg=null){
        $msg = '['.date('Y-m-d H:i:s').']'.$msg.chr(10);;
        fwrite(STDOUT, $msg);
    }
}