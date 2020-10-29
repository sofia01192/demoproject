<?php 
// if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('displayError')){
	function displayError($error,$field){
		if(isset($error)){
			if(array_key_exists($field,$error)){
				return $error[$field];
			}else{
				return false;
			}
		}
		
	}
}

if (!function_exists('getRandomWord'))
{
	function getRandomWord($len) {
	    $word = array_merge(range('a', 'z'), range('A', 'Z'), range('1', '0'));
	    shuffle($word);
	    return substr(implode($word), 0, $len);
	}
}

if (!function_exists('debug'))
{
    function debug()
    {
        array_map(function($x) { 
        	echo "<pre style='background:#efefef; padding:10px;'>";
            var_export($x); 
            echo "</pre>";
        }, func_get_args());
        die;
    }
}

if (!function_exists('getRecordOnId'))
{
	function getRecordOnId($table, $where){
		$db = \Config\Database::connect();
		$queryBuilder = $db->table($table);
		$queryBuilder->where($where);
		$query = $queryBuilder->get()->getResult();
		return $query[0];
	}
}

if (!function_exists('getRecordsOnQuery'))
{
	function getRecordsOnQuery($query){
		$db = \Config\Database::connect();
		$rs = $db->query($query)->result();
		return $rs;
	}
}


if (!function_exists('getRecordsDB'))
{
	function getRecordsDB($table, $where){
		$db = \Config\Database::connect();
		$db->from($table);
		$db->where($where);
		$query = $db->get();
		return $query->result();
	}
}

if (!function_exists('getCombo'))
{
	function getCombo($table, $selected='', $rename='', $attributes=''){
		$db = \Config\Database::connect();
		$text = str_replace('_', ' ', str_replace('_id', '', $rename));
		$attributeText = '';
		if(count($attributes) > 0){
			foreach($attributes as $key => $val){
				$attributeText .= " $key='$val'";
			}
		}

		$queryBuilder = $db->table($table);
		$queryBuilder->orderBy('title', 'asc');
		$ddList = $queryBuilder->get()->getResult();
		$records[''] = "Select Value";
		foreach($ddList as $ddl){
			$records[$ddl->id] = $ddl->title;
		}
		
		return form_dropdown($rename, $records, $selected, $attributes);
	}
}

if ( ! function_exists('assetUrl')){
  function assetUrl(){
    return base_url().'/public/';
  }
}

if ( ! function_exists('dateConverter')){
  function dateConverter($date, $format = 'd-M-Y h:i:s A'){
    return date($format, strtotime($date));
  }
}

if ( ! function_exists('listBetweenDates')){
	function listBetweenDates($date1, $date2, $format = 'Y-m-d' ) {
	    $dates = array();
	    $current = strtotime($date1);
	    $date2 = strtotime($date2);
	    $stepVal = '+1 day';
	    while( $current <= $date2 ) {
	        $dates[] = date($format, $current);
	        $current = strtotime($stepVal, $current);
	    }
	    return $dates;
	}
}

if ( ! function_exists('getServiceInfoById')){
	function getServiceInfoById($services, $id ) {
	    foreach ($services as $service) {
	    	//print_r($service);
	    	//print_r($id);
	    	if($service['service_id'] == $id) {
	    		return $service;
	    	}
	    }
	    $tmp['price'] = 0;
	    $tmp['duration'] = '';
	    return $tmp;
	}
}