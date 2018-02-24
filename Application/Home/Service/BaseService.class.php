<?php
/**
 * Created by PhpStorm.
 * User: Tmc
 * Date: 2017/2/18
 * Time: 11:00
 */

namespace Home\Service;

use Think\Cache\Driver\Redis;

class BaseService {
    public $redis;
    public $session_id;

    public function __construct() {

	}
}
