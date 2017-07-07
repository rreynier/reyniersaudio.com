<?php

function getPartTypeList($conn,$modelId) {

	$partType = new PartType();    
	$partTypeIds = $partType->getPartTypeIds($conn,$modelId);    
	
	$i=0;
	$partTypeList = array();
	foreach ($partTypeIds as $partTypeId) {
		$partType = new partType();	
		$partTypeList[] = $partType->getPartType($conn,$partTypeIds[$i]);
		$i++;
	}	
	return $partTypeList;
}

function getPartListByPartType($conn,$filter) {

	$part = new Part();
    $partIds = array();
	$partIds = $part->getPartIds($conn,$filter); 
	if (count($partIds) > 0 ){
        $i=0;        
        foreach ($partIds as $partId) {
            $part = new part();
            $partList[] = $part->getPart($conn,$partIds[$i]);
            $i++;
        }
    }
	return $partList;
}

function getModelList($conn) {
  
    $model = new Model;
    $modelIds = $model->getModelIds($conn);
    foreach ($modelIds as $modelId) {
        $model = new Model;
        $model = $model->getModel($conn,$modelId);
        $models[] = $model;
    }
    return $models;
}

function getModelListActive($conn) {

    $model = new Model;
    $modelIds = $model->getModelIds($conn,1);
    foreach ($modelIds as $modelId) {
        $model = new Model;
        $model = $model->getModel($conn,$modelId);
        $models[] = $model;
    }
    return $models;
}

function getPartTypeListByModel($conn, $modelId)
{

    $model = new Model;
    $model->getModel($conn,$modelId);
    $model->getPartTypes($conn, '');    
    return $model->partTypes;
}

function getPartTypeListByItem($conn, $itemId) {


}

	