<?php
/**
 * Created by PhpStorm.
 * User: heimo
 * Date: 2018/8/16
 * Time: 下午4:30
 */
namespace common\services;

use common\exceptions\ApiException;

class Service
{
    public static function init(){}


    /**
     * 根据过滤条件返回数据对象
     * @param $class
     * @param array $filterWhere
     * @return \yii\db\ActiveQuery
     */
    public static function getFilterModel($class, array $filterWhere = [])
    {
        $model = $class::find();

        if(!empty($filterWhere)){
            $model->andFilterWhere($filterWhere);
        }

        return $model;
    }

    /**
     * @param int  $totalCount
     * @param array $dataList
     *
     * @return array
     */
    public static function retListResArr($totalCount = 0, $dataList = [])
    {
        return [
            'totalCount' => (int) $totalCount,
            'dataList'  => $dataList
        ];
    }

    /**
     * @param int                     $code
     * @param int|string|array|       $message
     * @param int|string|array|static $data
     *
     * @return array
     */
    public static function returnRet($code, $message, $data = [])
    {
        return [
            'code' => (int) $code,
            'data'  => $data,
            'message'  => $message
        ];
    }


    /**
     * 过滤表单error
     * @param array $errors
     * @return array
     */
    public static function returnError($errors = []){
        $return = [];
        if (count($errors) > 0){
            foreach ($errors as $item){
                $return[] = $item[0];
            }
        }

        return $return;
    }

    /**
     * 抽取$model->getFirstErrors 中的文本错误提示
     *
     * @param $ErrArr
     *
     * @return string
     */
    public static function getModelFirstErrText($ErrArr)
    {
        $r = array_values($ErrArr);
        return isset($r[0]) ? $r[0] : '';
    }

}
