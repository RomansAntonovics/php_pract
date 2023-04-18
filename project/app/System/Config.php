<?php

namespace App\System;

class Config
{
    /** @var array */
    private $cfg;

    public function __construct($config)
    {
        /** @var array cfg */
        $this->cfg = $config;
    }

    public function get($key)
    {
        $keyArr = explode('.', $key);
        $result = null;
        $searchArr = $this->cfg;

        for($i = 0; $i < count($keyArr); $i++) {

            if(!isset($searchArr[$keyArr[$i]])) {

                break;

            } else {

                if($i < (count($keyArr) - 1)) {
                    $searchArr = $searchArr[$keyArr[$i]];
                }
            }

            if($i == (count($keyArr) - 1)) {
                $result = $searchArr[$keyArr[$i]];
            }
        }

        return $result;
    }
}