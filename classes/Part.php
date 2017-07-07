<?php

class Part {

    public $id;
    public $title;
    public $titleClean;
    public $shortTitle;
    public $shortDesc;
    public $longDesc;
    public $partCost;
    public $mapPrice;
    public $discount;
    public $profitPercent;
    public $order;
    public $dateAdded;
    public $option1Text;
    public $option1Cost;
    public $option2Text;
    public $option2Cost;
    public $option3Text;
    public $option3Cost;
    public $subTypes = array();
    public $images = array ();
    public $tags;


    public function __construct () {
        $this->id = NULL;
        $this->title = NULL;
        $this->titleClean = NULL;
        $this->shortTitle = NULL;
        $this->shortDesc = NULL;
        $this->longDesc = NULL;
        $this->partCost = 0;
        $this->mapPrice = 0;
        $this->discount = 0;
        $this->profitPercent = 0;
        $this->order = 0;
        $this->dateAdded = NULL;
        $this->option1Text = NULL;
        $this->option1Cost = 0;
        $this->option2Text = NULL;
        $this->option2Cost = 0;
        $this->option3Text = NULL;
        $this->option3Cost = 0;
        $this->subTypes = array();
        $this->active = NULL;
        $this->tags = NULL;
        
    }


    function setPart ($id,$title,$shortTitle,$shortDesc,$longDesc,$partCost,$mapPrice,$discount,$profitPercent,$order,$option1Text,$option1Cost,$option2Text,$option2Cost,$option3Text,$option3Cost,$active,$tags) {
        $this->id = $id;
        $this->title = $title;
        $this->shortTitle = $shortTitle;
        $this->shortDesc = $shortDesc;
        $this->longDesc = $longDesc;
        $this->partCost = $partCost;
        $this->mapPrice = $mapPrice;
        $this->discount = $discount;
        $this->profitPercent = $profitPercent;
        $this->order = $order;
        $this->option1Text = $option1Text;
        $this->option1Cost = $option1Cost;
        $this->option2Text = $option2Text;
        $this->option2Cost = $option2Cost;
        $this->option3Text = $option3Text;
        $this->option3Cost = $option3Cost;
        $this->active = $active;
        $this->tags = $tags;
    }



    function getSubTypes ($conn) {
        $query = "SELECT sub_type_id_fk FROM part_line INNER JOIN part
                  ON part.part_id = part_line.part_id_fk WHERE part.part_id = ?";
        
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id );
            $stmt->bind_result($subTypeId);
            $stmt->execute();
            while ($stmt->fetch()) {
                $subTypeIds[] = $subTypeId;
            }
            require_once 'classes/SubType.php';
            if(count($subTypeIds) > 0) {
                foreach ($subTypeIds as $subTypeId) {
                    $subType = new subType();
                    $this->subTypes[] = $subType->getSubType($conn,$subTypeId);
                }
            }

            return $this->subTypes;

        } else {
            echo '<span class="failure">Something went wrong (getPartTypes)</span>';
        }
    }


    function getPart ($conn, $id) {
        $query = "SELECT * FROM part WHERE part_id = ? LIMIT 1";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i',$id);
            $stmt->bind_result(
                    $this->id,
                    $this->title,
                    $this->shortTitle,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->partCost,
                    $this->mapPrice,
                    $this->discount,
                    $this->profitPercent,
                    $this->order,
                    $this->dateAdded,
                    $this->option1Text,
                    $this->option1Cost,
                    $this->option2Text,
                    $this->option2Cost,
                    $this->option3Text,
                    $this->option3Cost,
                    $this->active,
                    $this->tags
            );
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            $this->titleClean = strip_tags($this->title);
            $this->titleClean = str_replace(' ','-',$this->titleClean);
            $this->titleClean = str_replace('.','-',$this->titleClean);
            $this->titleClean = str_replace("'",'',$this->titleClean);
            $this->titleClean = str_replace("/",'-',$this->titleClean);
            return $this;
        }
        else {
            echo '<br />Something went wrong! (getPart)';
        }

    }

    function addPart ($conn) {
        $query = "INSERT INTO part (
						`title`,
						`short_title`,
						`short_desc`,
						`long_desc`,
						`part_cost`,
						`map_price`,
						`discount`,
						`profit_percent`,
						`order`,
						`option1_text`,
						`option1_cost`,
						`option2_text`,
						`option2_cost`,
						`option3_text`,
						`option3_cost`,
                                                `active`,
                                                `tags`
                                                )
					VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ssssssssissssssss',
                    $this->title,
                    $this->shortTitle,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->partCost,
                    $this->mapPrice,
                    $this->discount,
                    $this->profitPercent,
                    $this->order,
                    $this->option1Text,
                    $this->option1Cost,
                    $this->option2Text,
                    $this->option2Cost,
                    $this->option3Text,
                    $this->option3Cost,
                    $this->active,
                    $this->tags
            );
            $stmt->execute();

            $stmt->fetch();
            $stmt->close();

            return $conn->insert_id;
        }
        else {
            echo $conn->error;
            echo '<br />Something went wrong (addPart)';
        }
    }


    function updatePart ($conn) {
        $query = "UPDATE `part` SET
                    `title` = ?,
                    `short_title` = ?,
                    `short_desc` = ?,
                    `long_desc` = ?,
                    `part_cost` = ?,
                    `map_price` = ?,
                    `discount` = ?,
                    `profit_percent` = ?,
                    `order` = ?,
                    `option1_text` = ?,
                    `option1_cost` = ?,
                    `option2_text` = ?,
                    `option2_cost` = ?,
                    `option3_text` = ?,
                    `option3_cost` = ?,
                    `active` = ?,
                    `tags` = ?
                  WHERE `part_id` = ? ";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ssssssssissssssssi' ,
                    $this->title,
                    $this->shortTitle,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->partCost,
                    $this->mapPrice,
                    $this->discount,
                    $this->profitPercent,
                    $this->order,
                    $this->option1Text,
                    $this->option1Cost,
                    $this->option2Text,
                    $this->option2Cost,
                    $this->option3Text,
                    $this->option3Cost,
                    $this->active,
                    $this->tags,
                    $this->id
                    
            );
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;            
            $stmt->close();
            # Set current part to the updated version
            $this->getPart($conn, $this->id);
            return $result;
        }
        else {
            echo $stmt->error . $conn->error . '<br />Something went wrong (updatePart)';
        }
    }

    function addSubType ($conn, $subTypeId) {
        $query = "INSERT INTO part_line (`sub_type_id_fk`,`part_id_fk`) VALUES (?,?)";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii', $subTypeId, $this->id);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        } else echo '<span class="failure">Something went wrong (addSubType)</span>';

    }

    function deleteSubType ($conn,$subTypeId) {
        $query = "DELETE FROM part_line WHERE sub_type_id_fk = ? AND part_id_fk = ?";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii',$subTypeId,$this->id);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
        else {
            echo $conn->error . ' DB Error (deleteSubType)';
        }

    }

    function deletePart ($conn, $id) {
        $query = "DELETE FROM part WHERE part_id = ? ";

        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        }
        else {
            echo $conn->error . $stmt->error;
        }
    }

    function countParts($conn,$field,$data,$dataType,$active = 1) {

        if ($field == NULL) {
            $query = "SELECT * FROM part WHERE active = $active";
            if($stmt = $conn->prepare($query)) {
                $execute = 1;
            }
        }

        else {
            $query = "SELECT * FROM part WHERE $active = 1 AND $field = ?";
            if($stmt = $conn->prepare($query)) {
                $execute = 1;
                $stmt->bind_param($dataType, $data);
            }
        }

        if ($execute == 1) {
            $stmt->execute();
            $stmt->store_result();
            $partCount = $stmt->num_rows;
            $stmt->close();
            return $partCount;
        }
        else {
            echo '<br />Something went wrong (countParts)';
        }


    }

    function getPartIds ($conn,$filter,$active = 1) {
        if ($filter == NULL) {
            $partIds = array();
            $query = "SELECT part_id FROM part WHERE active = $active";
            if ($result = $conn->query($query)) {

                $result->num_rows;

                while ($row = $result->fetch_object()) {
                    $partIds[] = $row->part_id;
                }
            }
            else {
                echo '<span class="failure">Something went wrong (getPartIds)</span>';
            }

        }

        else {
            $query = "SELECT part_id FROM part INNER JOIN part_line
						ON part.part_id = part_line.part_id_fk WHERE active = $active AND part_line.part_type_id_fk = ?";
            if($stmt = $conn->prepare($query)) {
                $stmt->bind_param(i, $filter);
                $stmt->bind_result($partId);
                $stmt->execute();
                while ($stmt->fetch()) {
                    $partIds[] = $partId;
                }
            }
            else {
                echo '<span class="failure">Something went wrong (getPartIds)</span>';
            }

        }

        return $partIds;
    }

    function checkDefault ($conn, $subTypeId, $modelId) {
        $query = "SELECT * FROM `model_part_line` WHERE `part_id_fk` = ? AND `sub_type_id_fk` = ? AND `model_id_fk` = ? AND `default` = 1";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('iii', $this->id, $subTypeId, $modelId);
            $stmt->execute();
            $stmt->store_result();
            $result = $stmt->num_rows;
            $stmt->close();
            return $result;
        }
        else echo $conn->error . 'db error';
    }

    function getImages ($conn) {
        $query = "SELECT part_img_id FROM part_img WHERE part_id_fk = ? ORDER BY `order`";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i',$this->id);
            $stmt->bind_result($imageId);
            $stmt->execute();
            $imageIds = array();
            while ($stmt->fetch()) {
                $imageIds[] = $imageId;
            }
            $stmt->close();
            foreach ((array)$imageIds as $imageId) {
                require_once 'Image.php';
                $image = new Image();
                $image->get($conn,$imageId);
                $this->images[] = $image;
            }
        }
        else echo $stmt->error.$conn->error;
    }

    function getPrice() {
        return round($this->partCost * ( 1 + $this->profitPercent ));
    }
    
    function clonePart($conn,$partId) {
        
        // Get the names of all fields/columns in the table
        $query = 'SHOW COLUMNS FROM part';
        $result = $conn->query($query);

        // Generate and run the duplication query with those fields except the key
        $query = 'INSERT INTO part (SELECT ';        
        $i = 0;        
        while ($row = $result->fetch_array()) {
            $query .= ($i++ > 0 ? ' ,' : '');
            if ($row[0] == 'part_id' || $row[0] == 'date_added') {
                $query .= 'NULL';
            } else {
                $query .=  '`' . $row[0] . '`';
            } 
        } 
        $query .= ' FROM part WHERE part_id = "' . $partId . '")';
        $conn->query($query);        
        $newPartId = $conn->insert_id;
        
        // Add subtype relationships to duplicated part
        $query = 'SELECT * FROM part_line WHERE part_id_fk = ' . $partId;        
        $result = $conn->query($query);        
        while($row = $result->fetch_array()) {            
            $query = 'INSERT INTO part_line (part_id_fk,sub_type_id_fk) VALUE (' . $newPartId . ','. $row['sub_type_id_fk'] .')';    
            $conn->query($query);            
        } 

        return $newPartId;
    }     
    
    function getPartsByPartType($conn,$partTypeId,$active = 1,$order_by = null) {
        
        $partTypeId = sanitize($conn,$partTypeId);
        
        if($order_by != null) {
            
            $order_by = ' ORDER BY ' . sanitize($conn,$order_by['field']) . ' ' . sanitize($conn,$order_by['direction']);
        } else {
            
            $order_by = ' ORDER BY part_title';
        }
        
        $query = "SELECT *, 
            part.title as part_title, 
            part.short_title as part_short_title,
            part.long_desc as part_long_desc,
            part.short_desc as part_short_desc,
            sub_type.title as sub_type_title,
            sub_type.short_title as sub_type_short_title,
            part.part_cost - discount as part_price,
            part_img.title as part_img_title
            FROM part 
            JOIN part_line ON part.part_id = part_line.part_id_fk 
            JOIN sub_type ON part_line.sub_type_id_fk = sub_type.sub_type_id
            JOIN part_img ON part.part_id = part_img.part_id_fk
            WHERE part.active = $active AND sub_type.part_type_id_fk = $partTypeId AND part_img.order = 1 AND part.part_cost > 0
            GROUP BY part_img.part_id_fk
            $order_by"; 
        
        $result = $conn->query($query);
        
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            
            $parts[] = $row;
            
        }

        
        
        return $parts;
        
        
    }
}

?>