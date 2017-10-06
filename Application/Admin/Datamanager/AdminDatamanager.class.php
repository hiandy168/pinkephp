<?php
namespace Admin\Datamanager;
class AdminDatamanager{

 	function __construct() {

	}

    public function getData($p=1,$page_size=20,$map=array(),$order=""){
        $data = $this->_takeFormatData("data",$map,$p,$page_size,$order);
        return $data;
    }

    public function getInfo($id){
        $map['id'] = $id;
        $data = $this->_takeFormatData("data",$map,1,1);
        return $data[0];
    }

    public function getNum($map){
        $data = $this->_takeData("num",$map);
        return $data;
    }

    private function _takeFormatData($type="",$map=array(),$p=1,$page_size=10,$order=""){
        $data = $this->_takeData("data",$map,$p,$page_size,$order);
        return $data;
    }

    private function _takeData($type="data",$searchmap=array(),$p=1,$page_size=20,$order=" id desc "){
        $map = array();

        //合并覆盖
        $newmap = array_merge($map, $searchmap);

        $offset = ($p - 1) * $page_size;
        $offset = $offset < 0 ? 0 : $offset;

        if($type=="data"){
            $list = M("Admin")
                    ->field('*')
                    ->where($newmap)
                    ->order($order)
                    ->limit($offset.','.$page_size)
                    ->select();
        }else{
            $list = M("Admin")
                    ->field('id')
                    ->where($newmap)
                    ->count();
        }
        return $list;
    }
}