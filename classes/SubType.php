<?php

class subType {

    public $id;
    public $partTypeId;
    public $title;
    public $shortTitle;
    public $desc;
    public $selectVerbage;
    public $order;
    public $dateAdded;
    public $inputType;
    public $parts = array();

    public function __construct() {
        $this->id = NULL;
        $this->partTypeId = NULL;
        $this->title = NULL;
        $this->shortTitle = NULL;
        $this->desc = NULL;
        $this->selectVerbage = NULL;
        $this->order = NULL;
        $this->dateAdded = NULL;
        $this->inputType = NULL;
        $this->parts = array();
    }

    function setSubType($id, $partTypeId, $title, $shortTitle, $desc, $selectVerbage, $order, $inputType) {
        $this->id = $id;
        $this->partTypeId = $partTypeId;
        $this->title = $title;
        $this->shortTitle = $shortTitle;
        $this->desc = $desc;
        $this->selectVerbage = $selectVerbage;
        $this->order = $order;
        $this->inputType = $inputType;
    }

    function getSubType($conn, $id) {
        $query = "SELECT * FROM sub_type WHERE sub_type_id = ? LIMIT 1";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result(
                    $this->id,
                    $this->partTypeId,
                    $this->title,
                    $this->shortTitle,
                    $this->desc,
                    $this->selectVerbage,
                    $this->order,
                    $this->dateAdded,
                    $this->inputType
            );

            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            return $this;
        } else {
            echo '<br />Something went wrong! (getsubType)';
        }
    }

    function addSubType($conn) {
        $query = "INSERT INTO sub_type (`part_type_id_fk`,`title`,`short_title`,`desc`,`select_verbage`,`order`,`input_type`)
                VALUES (?,?,?,?,?,?,?)";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('issssis',
                    $this->partTypeId,
                    $this->title,
                    $this->shortTitle,
                    $this->desc,
                    $this->selectVerbage,
                    $this->order,
                    $this->inputType
            );
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            return $conn->insert_id;
        } else {
            echo '<br />Something went wrong (addsubType)';
        }
    }

    function updateSubType($conn) {
        $query = "UPDATE sub_type SET
                    `part_type_id_fk` = ?, `title` = ?,`short_title` = ?,`desc` = ?,`select_verbage` = ?,`order` = ?,`input_type` = ?
                  WHERE `sub_type_id` = ? ";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('issssisi',
                    $this->partTypeId,
                    $this->title,
                    $this->shortTitle,
                    $this->desc,
                    $this->selectVerbage,
                    $this->order,
                    $this->inputType,
                    $this->id
            );
            $stmt->execute();
            $stmt->fetch();
            $result = $stmt->affected_rows;
            $stmt->close();
            return $result;
        } else {
            echo '<br />Something went wrong (addsubType)';
        }
    }

    function deleteSubType($conn, $id) {
        $query = "DELETE FROM sub_type WHERE `sub_type_id` = ? ";

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

    function getSubTypes($conn) {
        $query = "SELECT `sub_type_id` FROM sub_type ORDER BY title";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_result($subTypeId);
            $stmt->execute();
            while ($stmt->fetch()) {
                $subTypeIds[] = $subTypeId;
            }
            if (count($subTypeIds) > 0) {
                foreach ($subTypeIds as $subTypeId) {
                    $subType = new subType();
                    $subTypes[] = $subType->getSubType($conn, $subTypeId);
                }
                return $subTypes;
            }
            $stmt->close;
        } else {
            echo '<span class="failure">Something went wrong (getSubTypes)</span>';
        }
    }

    function getParts($conn,$active = 1) {
        $query = "SELECT part_id_fk FROM part_line INNER JOIN part ON part.part_id = part_line.part_id_fk WHERE part.active = $active AND sub_type_id_fk = ? ORDER BY part.part_cost";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($partId);
            $stmt->execute();
            $partIds = array();
            while ($stmt->fetch()) {
                $partIds[] = $partId;
            }
            
            if($partIds) {
                foreach ((array) $partIds as $partId) {
                    $part = new Part();
                    $this->parts[] = $part->getPart($conn, $partId);
                }
            }
            return $this->parts;
        }
    }

    function getPartType($conn) {
        $query = "SELECT part_type_id_fk FROM sub_type WHERE sub_type_id = ? LIMIT 1";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($partTypeId);
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            return $partTypeId;
        }
    }

}

?>
