<?php

class PartType {

    public $id;
    public $title;
    public $shortTitle;
    public $name;
    public $shortDesc;
    public $longDesc;
    public $decisionFactors;
    public $helpMeDecide;
    public $customTabTitle;
    public $customTabContent;
    public $customTabTitle2;
    public $customTabContent2;
    public $customTabTitle3;
    public $customTabContent3;
    public $customTabTitle4;
    public $customTabContent4;
    public $customTabTitle5;
    public $customTabContent5;
    public $profitPercentage;
    public $imgTitleUrl;
    public $order;
    public $dateAdded;
    public $parts = array();
    public $subTypes = array();

    public function __construct() {
        $this->id = NULL;
        $this->title = NULL;
        $this->shortTitle = NULL;
        $this->name = NULL;
        $this->shortDesc = NULL;
        $this->longDesc = NULL;
        $this->decisionFactors = NULL;
        $this->helpMeDecide = NULL;
        $this->customTabTitle = NULL;
        $this->customTabContent = NULL;
        $this->customTabTitle2 = NULL;
        $this->customTabContent2 = NULL;
        $this->customTabTitle3 = NULL;
        $this->customTabContent3 = NULL;
        $this->customTabTitle4 = NULL;
        $this->customTabContent4 = NULL;
        $this->customTabTitle5 = NULL;
        $this->customTabContent5 = NULL;
        $this->profitPercentage = NULL;
        $this->imgTitleUrl = NULL;
        $this->order = NULL;
        $this->dateAdded = NULL;
        $this->parts = array();
        $this->subTypes = array();
    }

    function setPartType($id, $title, $shortTitle, $name, $shortDesc, $longDesc, $decisionFactors, $helpMeDecide, $customTabTitle, $customTabContent, $customTabTitle2, $customTabContent2, $customTabTitle3, $customTabContent3, $customTabTitle4, $customTabContent4, $customTabTitle5, $customTabContent5, $profitPercentage, $imgTitleUrl, $order) {
        $this->id = $id;
        $this->title = $title;
        $this->shortTitle = $shortTitle;
        $this->name = $name;
        $this->shortDesc = $shortDesc;
        $this->longDesc = $longDesc;
        $this->decisionFactors = $decisionFactors;
        $this->helpMeDecide = $helpMeDecide;
        $this->customTabTitle = $customTabTitle;
        $this->customTabContent = $customTabContent;
        $this->customTabTitle2 = $customTabTitle2;
        $this->customTabContent2 = $customTabContent2;
        $this->customTabTitle3 = $customTabTitle3;
        $this->customTabContent3 = $customTabContent3;
        $this->customTabTitle4 = $customTabTitle4;
        $this->customTabContent4 = $customTabContent4;
        $this->customTabTitle5 = $customTabTitle5;
        $this->customTabContent5 = $customTabContent5;
        $this->profitPercentage = $profitPercentage;
        if(!is_numeric($this->profitPercentage)) { $this->profitPercentage = 0; }
        
        $this->imgTitleUrl = $imgTitleUrl;
        $this->order = $order;       
    }

    function getPartType($conn, $id) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/misc.php';
        $id = sanitize($conn,$id);

        $query = "SELECT * FROM part_type WHERE part_type_id = ? ORDER BY title LIMIT 1";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result(
                    $this->id,
                    $this->title,
                    $this->shortTitle,
                    $this->name,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->decisionFactors,
                    $this->helpMeDecide,
                    $this->customTabTitle,
                    $this->customTabContent,
                    $this->customTabTitle2,
                    $this->customTabContent2,
                    $this->customTabTitle3,
                    $this->customTabContent3,
                    $this->customTabTitle4,
                    $this->customTabContent4,
                    $this->customTabTitle5,
                    $this->customTabContent5,
                    $this->profitPercentage,
                    $this->imgTitleUrl,
                    $this->order,
                    $this->dateAdded
            );
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            return $this;
        } else {
            echo '<span class="failure">Something went wrong (getPartType)</span>';
        }
    }

    function updatePartType($conn) {
        $query = "UPDATE `part_type` SET
                        `title` = ?,
                        `short_title` = ?,
                        `name` = ?,
                        `short_desc` = ?,
                        `long_desc` = ?,
                        `decision_factors` = ?,
                        `help_me_decide` = ?,
                        `custom_tab_title` = ?,
                        `custom_tab_content` = ?,
                        `custom_tab_title_2` = ?,
                        `custom_tab_content_2` = ?,
                        `custom_tab_title_3` = ?,
                        `custom_tab_content_3` = ?,
                        `custom_tab_title_4` = ?,
                        `custom_tab_content_4` = ?,
                        `custom_tab_title_5` = ?,
                        `custom_tab_content_5` = ?,
                        `profit_percentage` = ?,
                        `img_title_url` = ?,
                        `order` = ?
				  	WHERE `part_type_id` = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssssssssssssssssii',
                    $this->title,
                    $this->shortTitle,
                    $this->name,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->decisionFactors,
                    $this->helpMeDecide,
                    $this->customTabTitle,
                    $this->customTabContent,
                    $this->customTabTitle2,
                    $this->customTabContent2,
                    $this->customTabTitle3,
                    $this->customTabContent3,
                    $this->customTabTitle4,
                    $this->customTabContent4,
                    $this->customTabTitle5,
                    $this->customTabContent5,
                    $this->profitPercentage,
                    $this->imgTitleUrl,
                    $this->order,
                    $this->id
            );
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
               $stmt->close();
            # Set current part_type to the updated/new version
            $this->getPartType($conn, $this->id);
            return $result;
        } else {
            echo $conn->error;
            echo 'DB Error (updatePartType)';
        }
    }

    function addPartType($conn) {

        $query = "INSERT INTO part_type (
            `title`,
            `short_title`,
            `name`,
            `short_desc`,
            `long_desc`,
            `decision_factors`,
            `help_me_decide`,
            `custom_tab_title`,
            `custom_tab_content`,
            `custom_tab_title_2`,
            `custom_tab_content_2`,
            `custom_tab_title_3`,
            `custom_tab_content_3`,
            `custom_tab_title_4`,
            `custom_tab_content_4`,
            `custom_tab_title_5`,
            `custom_tab_content_5`,
            `profit_percentage`,
            `img_title_url`,
            `order`)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('sssssssssssssssssssi',
                    $this->title,
                    $this->shortTitle,
                    $this->name,
                    $this->shortDesc,
                    $this->longDesc,
                    $this->decisionFactors,
                    $this->helpMeDecide,
                    $this->customTabTitle,
                    $this->customTabContent,
                    $this->customTabTitle2,
                    $this->customTabContent2,
                    $this->customTabTitle3,
                    $this->customTabContent3,
                    $this->customTabTitle4,
                    $this->customTabContent4,
                    $this->customTabTitle5,
                    $this->customTabContent5,
                    $this->profitPercentage,
                    $this->imgTitleUrl,
                    $this->order
            );
            $stmt->execute();
            $stmt->fetch();            
            $result = $conn->insert_id;
            $stmt->close();
            return $result;
        } else {
            echo $conn->error;
            echo 'DB Error (addPartType)';
        }
    }

    function deletePartType($conn, $id) {
        $query = "DELETE FROM part_type WHERE part_type_id = ? ";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        } else {
            echo $conn->error . $stmt->error;
        }
    }

    function countPartTypes($conn, $filter) {

        if ($filter == NULL) {
            $query = "SELECT * FROM part_type";
            if ($stmt = $conn->prepare($query)) {
                $execute = 1;
            }
        } else {
            $query = 'SELECT * FROM part_type INNER JOIN part_line
						ON part_type.part_type_id = part_line.part_type_id_fk WHERE part_type_id = ?';
            if ($stmt = $conn->prepare($query)) {
                $execute = 1;
                $stmt->bind_param('i', $filter);
            }
        }

        if ($execute == 1) {
            $stmt->execute();
            $stmt->store_result();
            $partTypeCount = $stmt->num_rows;
            $stmt->close();
            return $partTypeCount;
        } else {
            echo '<span class="failure">Something went wrong (countPartTypes)</span>';
        }
    }

    function getPartTypeIds($conn, $filter) {
        if ($filter == NULL) {
            $query = "SELECT part_type_id FROM part_type ORDER BY `order`";
            if ($result = $conn->query($query)) {
                while ($row = $result->fetch_object()) {
                    $partTypeIds[] = $row->part_type_id;
                }
            } else {
                echo '<span class="failure">Something went wrong (getPartTypeIds)</span>';
            }
        } else {

            $query = 'SELECT part_type_id FROM part_type INNER JOIN part_line
						ON part_type.part_type_id = part_line.part_type_id_fk WHERE part_line.part_id_fk = ?';
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('i', $filter);
                $stmt->bind_result($partTypeId);
                $stmt->execute();
                while ($stmt->fetch()) {
                    $partTypeIds[] = $partTypeId;
                }
                $stmt->close;
            } else {
                echo '<span class="failure">Something went wrong (getPartTypeIds)</span>';
            }
        }

        return $partTypeIds;
    }

    function getPartTypes($conn) {
        $partTypeIds = $this->getPartTypeIds($conn, '');
        if (count($partTypeIds > 0)) {

            foreach ($partTypeIds as $partTypeId) {
                $partType = new PartType;
                $partTypes[] = $partType->getPartType($conn, $partTypeId);
            }
        }
        return $partTypes;
    }

    function getParts($conn,$active = 1) {
        $query = "SELECT part_id_fk  FROM part_line INNER JOIN part_type
                  ON part_line.part_type_id_fk = part_type.part_type_id INNER JOIN part ON part.part_id = part_line.part_id_fk WHERE part.active = $active part_type.part_type_id = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($partId);
            $stmt->execute();
            while ($stmt->fetch()) {
                $partIds[] = $partId;
            }
            require_once 'classes/Part.php';
            if (count($partIds) > 0) {
                foreach ($partIds as $partId) {
                    $part = new Part();
                    $this->parts[] = $part->getPart($conn, $partId);
                }
            }
            $stmt->close;
            return $this->parts;
        } else {
            echo '<span class="failure">Something went wrong (getParts)</span>';
        }
    }

    function deletePart($conn, $partId) {
        $query = "DELETE FROM part_line WHERE part_id_fk = ? AND part_type_id_fk = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii', $partId, $this->id);
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        } else {
            echo $conn->error . ' DB Error (deletePart)';
        }
    }

    function getSubTypes($conn) {
        $query = "SELECT sub_type_id FROM sub_type WHERE part_type_id_fk = ? ORDER BY `order`";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($subTypeId);
            $stmt->execute();
            require_once 'classes/SubType.php';
            while ($stmt->fetch()) {
                $subTypeIds[] = $subTypeId;
            }
            if (count($subTypeIds > 0)) {
                foreach ((array) $subTypeIds as $subTypeId) {
                    $subType = new SubType();
                    $this->subTypes[] = $subType->getSubType($conn, $subTypeId);
                }
                return $this->subTypes;
            }
        }
        else
            echo $conn->error;
    }

}

?>