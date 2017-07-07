<?php

class Model {
    public $id;
    public $title;
    public $shortDesc;
    public $longDesc;
    public $basePrice;
    public $discount;
    public $tab1Title;
    public $tab1Content;
    public $tab2Title;
    public $tab2Content;
    public $tab3Title;
    public $tab3Content;
    public $tab4Title;
    public $tab4Content;
    public $tab5Title;
    public $tab5Content;
    public $imgTitle;
    public $imgTitle2;
    public $order;
    public $dateAdded;
    public $partTypes;
    public $active;
    public $titleClean;
    public $shortDescClean;

	function __constructor() {
	$this->id = NULL;
        $this->title = NULL;
        $this->shortDesc = NULL;
        $this->longDesc = NULL;
        $this->baseprice = NULL;
        $this->discount = NULL;
        $this->tab1Title = NULL;
        $this->tab1Content = NULL;
        $this->tab2Title = NULL;
        $this->tab2Content = NULL;
        $this->tab3Title = NULL;
        $this->tab3Content = NULL;
        $this->tab4Title = NULL;
        $this->tab4Content = NULL;
        $this->tab5Title = NULL;
        $this->tab5Content = NULL;
        $this->imgTitle = NULL;
		$this->imgTitle2 = NULL;
        $this->order = NULL;
        $this->dateAdded = NULL;
        $this->partTypes = array();
        $this->active = NULL;
        $this->titleClean = NULL;
        $this->shortDescClean = NULL;
	}

    function setModel($id,$title,$shortDesc,$longDesc,$basePrice,$discount,
      $tab1Title,$tab1Content,$tab2Title,$tab2Content,$tab3Title,$tab3Content,
      $tab4Title,$tab4Content,$tab5Title,$tab5Content,$imgTitle,$imgTitle2,$order,$active) {
        $this->id = $id;
        $this->title = $title;
        $this->shortDesc = $shortDesc;
        $this->longDesc = $longDesc;
        $this->basePrice = $basePrice;
        $this->discount = $discount;
        $this->tab1Title = $tab1Title;
        $this->tab1Content = $tab1Content;
        $this->tab2Title = $tab2Title;
        $this->tab2Content = $tab2Content;
        $this->tab3Title = $tab3Title;
        $this->tab3Content = $tab3Content;
        $this->tab4Title = $tab4Title;
        $this->tab4Content = $tab4Content;
        $this->tab5Title = $tab5Title;
        $this->tab5Content = $tab5Content;
        $this->imgTitle = $imgTitle; 
	$this->imgTitle2 = $imgTitle2;  		
        $this->order = $order;
        $this->active = $active;
    }

    function getModel($conn, $id, $active = 0) {
        if ($active == 1) { $active = ' AND `active` = 1'; } else { $active = ''; }
        $query = "SELECT * FROM model WHERE model_id = ?".$active." LIMIT 1";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result(
                $this->id,
                $this->title,
                $this->shortDesc,
                $this->longDesc,
                $this->basePrice,
                $this->discount,
                $this->tab1Title,
                $this->tab1Content,
                $this->tab2Title,
                $this->tab2Content,
                $this->tab3Title,
                $this->tab3Content,
                $this->tab4Title,
                $this->tab4Content,
                $this->tab5Title,
                $this->tab5Content,
                $this->imgTitle,
		$this->imgTitle2,
                $this->order,
                $this->dateAdded,
                $this->active
            );
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            $this->shortDescClean = strip_tags($this->shortDesc);
            $this->shortDescClean = str_replace(' ','-',$this->shortDescClean);
            $this->shortDescClean = str_replace('/','-',$this->shortDescClean);
            $this->shortDescClean = str_replace("'",'',$this->shortDescClean);
            $this->titleClean = strip_tags($this->title);
            $this->titleClean = str_replace(' ','-',$this->titleClean);
            $this->titleClean = str_replace('/','-',$this->titleClean);
            $this->titleClean = str_replace("'",'',$this->titleClean);
            return $this;
        } else { echo 'DB Error (getModel)'; }

    }

    function addModel($conn) {
        $query = "INSERT INTO model (`title`,`short_desc`,`long_desc`,`base_price`,`discount`,
                    `tab1_title`,`tab1_content`,`tab2_title`,`tab2_content`,`tab3_title`,`tab3_content`,
                    `tab4_title`,`tab4_content`,`tab5_title`,`tab5_content`,`img_title`,`img_title2`,`order`,`active`)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssssssssssssssii',
                $this->title,
                $this->shortDesc,
                $this->longDesc,
                $this->basePrice,
                $this->discount,
                $this->tab1Title,
                $this->tab1Content,
                $this->tab2Title,
                $this->tab2Content,
                $this->tab3Title,
                $this->tab3Content,
                $this->tab4Title,
                $this->tab4Content,
                $this->tab5Title,
                $this->tab5Content,
                $this->imgTitle,
		$this->imgTitle2,
                $this->order,
                $this->active
            );
            $stmt->execute();echo $stmt->error;
            $stmt->fetch();
            
            $stmt->close();
            return $conn->insert_id;
        }
        else {
			echo $conn->error;
            echo '<br />Something went wrong (addModel)';
        }
    }

    function updateModel($conn) {
        $query = "UPDATE model SET
                    `title` = ?,
                    `short_desc` = ?,
                    `long_desc` = ?,
                    `base_price` = ?, 
                    `discount` = ?,
                    `tab1_title` = ?,
                    `tab1_content` = ?,
                    `tab2_title` = ?,
                    `tab2_content` = ?,
                    `tab3_title` = ?,
                    `tab3_content` = ?,
                    `tab4_title` = ?,
                    `tab4_content` = ?,
                    `tab5_title` = ?,
                    `tab5_content` = ?,
                    `img_title` = ?,
                    `img_title2` = ?,
                    `order` = ?,
                    `active` = ?
                    WHERE `model_id` = ?";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssssssssssssssiii',
                $this->title,
                $this->shortDesc,
                $this->longDesc,
                $this->basePrice,
                $this->discount,
                $this->tab1Title,
                $this->tab1Content,
                $this->tab2Title,
                $this->tab2Content,
                $this->tab3Title,
                $this->tab3Content,
                $this->tab4Title,
                $this->tab4Content,
                $this->tab5Title,
                $this->tab5Content,
                $this->imgTitle,
		$this->imgTitle2,
                $this->order,
                $this->active,
                $this->id
            );
            $stmt->execute();
            echo $stmt->error;
            $stmt->fetch();
            $result = $stmt->affected_rows;            
            $stmt->close();
            return $result;
        } else { echo $conn->error . 'DB Error (updateModel)'; }
    }

    function getPartTypes($conn) {        
        $query = "SELECT part_type_id_fk FROM model_line 
			INNER JOIN model ON model_line.model_id_fk = model.model_id 
			INNER JOIN part_type ON model_line.part_type_id_fk = part_type.part_type_id
			WHERE model_id_fk = ? ORDER BY part_type.order";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i',$this->id);
            $stmt->bind_result($partTypeId);
            $stmt->execute();            
            while ($stmt->fetch()){
                $partTypeIds[] = $partTypeId;
            }
            if( count($partTypeIds) > 0 ) {
                foreach ($partTypeIds as $partTypeId) { 
                    require_once 'classes/PartType.php';
                    $partType = new PartType();
                    $this->partTypes[] = $partType->getPartType($conn,$partTypeId);
                }
            }

            return $this->partTypes;
        }
        else {echo 'DB Error (getPartTypes)';}
    }

    function addPartType($conn,$partType) {        
        $query = "INSERT INTO model_line (`part_type_id_fk`, `model_id_fk`) VALUES (?,?)";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii',$partType,$this->id);
            $stmt->execute();
                        echo $stmt->error;
            $stmt->fetch();
            $result = $stmt->affected_rows;

            $stmt->close();
            return $result;
        }       
        else { echo $conn->error . 'DB Error (addPartType)'; }
    }

    function deletePartType($conn,$partTypeId) {

        $query = 'SELECT sub_type_id FROM sub_type WHERE part_type_id_fk = ?';
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i',$partTypeId);
            $stmt->bind_result($subTypeId);
            $stmt->execute();
            while ($stmt->fetch()){
                $subTypeIds[] = $subTypeId;
            }
            $stmt->close();
        }
        foreach ((array)$subTypeIds as $subTypeId) {
            $query = "DELETE FROM model_part_line WHERE sub_type_id_fk = ? AND model_id_fk = ?";
            if($stmt = $conn->prepare($query)) {
                $stmt->bind_param('ii',$subTypeId,$this->id);
                $stmt->execute();
                $stmt->fetch();
                $result = $stmt->affected_rows;
                $stmt->close();
            }
        }
        $query = "DELETE FROM model_line WHERE part_type_id_fk = ? AND model_id_fk = ?";        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii',$partTypeId,$this->id);
            $stmt->execute();
            $stmt->fetch();            
            $result = $stmt->affected_rows;            
            $stmt->close();
            return $result;
        }


    }

    function deleteSubType($conn,$subTypeId) {
        $query = "UPDATE sub_type SET `part_type_id_fk` = NULL WHERE `sub_type_id` = ?";
        if($stmt = $conn->prepare($query)) {            
            $stmt->bind_param('i',$subTypeId);
            $stmt->execute();
            $stmt->fetch();
            echo $stmt->error;
            $result = $stmt->affected_rows;
            return $result;
            $stmt->close();
        }
        else { echo $conn->error . ' DB Error (deleteSubType)'; }
    }

    function deleteModel($conn,$modelId) {
        $query = "DELETE FROM model WHERE model_id = ?";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $modelId);
            $stmt->execute();
            echo $stmt->error;
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
    }

    function getModelIds($conn,$active=0) {
        if ($active == 1) {
            $where = 'WHERE `active` = 1';
        } else { $where = ''; }
        $query = "SELECT model_id FROM model " . $where . " ORDER BY `order`";
        if ($result = $conn->query($query)) {
            $modelIds = array();
            while ($row = $result->fetch_object()) {
                $modelIds[] = $row->model_id;
            }
            return $modelIds;
        }
        else { echo 'DB Error (getModelIds)' , $conn->error; exit(); }
    }

    function getParts($conn,$subTypeId,$active = 1) {
        $query = "SELECT part_id_fk FROM model_part_line INNER JOIN part ON model_part_line.part_id_fk = part.part_id WHERE part.active = $active AND model_id_fk = ? AND sub_type_id_fk = ? ORDER BY `order`, part_cost";
        if($stmt = $conn->prepare($query)){
            $stmt->bind_param('ii', $this->id, $subTypeId);
            $stmt->bind_result($partId);
            $stmt->execute();
            $partIds = null;
            while ($stmt->fetch()){
                $partIds[] = $partId;
            }
            $parts = array();            
            if(count($partIds) > 0){
                
                foreach($partIds as $partId) {
                    require_once 'classes/Part.php';                    
                    $part = new Part();
                    $parts[] = $part->getPart($conn,$partId);                    
                }
            }
            return $parts;
        }
        else echo $conn->error . $stmt->error . 'DB ERROR';

    }

    function addPart($conn,$subTypeId,$partId) {
        $query = "INSERT INTO model_part_line (`model_id_fk` , `sub_type_id_fk` , `part_id_fk`) VALUES ( ? , ? , ? )";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('iii',$this->id, $subTypeId, $partId);
            $stmt->execute();
            echo $stmt->error;
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
        else {echo 'DB Error (addPart)';}

    }
      
    function deletePart($conn,$subTypeId,$partId) {
        $query = "DELETE FROM model_part_line WHERE model_id_fk = ? AND sub_type_id_fk = ? AND part_id_fk = ?";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('iii',$this->id,$subTypeId,$partId);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            return $result;
            $stmt->close();

        }
        else { echo $conn->error . ' DB Error (deletePartType)'; }
    }

    function makePartDefault ($conn,$subTypeId,$partId) {
        $query = "UPDATE model_part_line SET `default` = 0 WHERE model_id_fk = ? AND sub_type_id_fk = ?";
        if($stmt = $conn->prepare($query)) {
			$stmt->bind_param( 'ii' , $this->id, $subTypeId );
			$stmt->execute();
			$stmt->fetch();
            $stmt->close();
		}
        else echo 'DB Error (makePartDefault)';
        $query = "UPDATE model_part_line SET `default` = 1 WHERE model_id_fk = ? AND sub_type_id_fk = ? AND part_id_fk = ?";
		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param( 'iii' , $this->id, $subTypeId, $partId );
			$stmt->execute();
			$stmt->fetch();
			$result = $stmt->affected_rows;
			$stmt->close();
			return $result;
		}
		else echo 'DB Error (makePartDefault)';
    }

    function getTotalBasePrice($conn) {
        $query = "SELECT part_cost, profit_percent FROM model_part_line INNER JOIN part ON model_part_line.part_id_fk = part.part_id WHERE model_id_fk = ? AND model_part_line.default = 1";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($partCost,$profitPercent);
            $stmt->execute();
            $totalBasePrice = $this->basePrice;

            while ($stmt->fetch()) {
                $totalBasePrice = round($totalBasePrice + ( $partCost * (1+$profitPercent) ));                    
            }
            $stmt->close();
           
            return $totalBasePrice;
        }
    }
	
	function getBasePriceHtml($conn) {
		$base = round($this->getTotalBasePrice($conn));                
		if($this->discount > 0) {
			/*$html = '<span class="preDiscountPrice">$' . number_format($base) . '</span>';*/
			$html = '<span class="preDiscountPrice">$' . $base . '</span>';
			$discountedBasePrice = $base - $this->discount;		
			/*$html .= '<span class="discountedBasePrice">$' . number_format($discountedBasePrice) . '</span>';*/
			$html .= '<span class="discountedBasePrice">$' . $discountedBasePrice . '</span>';
		} else { $html = '$' . number_format($base); }
		return $html;
	}
	
	function getDefaultParts ($conn,$active = 1) {
		$query = "SELECT * 
					FROM model_part_line 
						INNER JOIN part ON model_part_line.part_id_fk = part.part_id 
					WHERE part.active = $active AND model_part_line.default = 1 
						AND model_part_line.model_id_fk = " . $this->id;
		if($result = $conn->query($query)) {
			$fieldsInfo = $result->fetch_fields();	
			foreach((array)$fieldsInfo as $fieldInfo) {
				$fields[] = $fieldInfo->name;
			}

			$rowNumber = 0;
			while($row = $result->fetch_row()){
				$n = 0;
				foreach((array)$row as $data) {
					$parts[$rowNumber][$fields[$n]] = $data;					
					$n++;
				}
				$rowNumber++;
			}
		}		
		return $parts;
	}


}