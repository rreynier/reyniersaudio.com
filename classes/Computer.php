<?php

class Computer {
    public $id;
    public $modelId;
    public $parts;

    public function __construct () {
        $this->id = NULL;
        $this->modelId = NULL;
        $this->parts = array();
    }

    function setComputer($modelId,$parts) {
        $this->modelId = $modelId;
        $this->parts = $parts;

    }

    function getComputer($conn,$id) {
        $query = "SELECT model_id_fk FROM computer WHERE computer_id = ? LIMIT 1";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $id);
            $stmt->bind_result($modelId);
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            $this->modelId = $modelId;
            $this->id = $id;
        }

    }


    function addComputer($conn) {

        // Find a random computer id that has not been used.
        $used = 1;
        while ($used == 1) {
            $random = rand(100000, 999999);
            $query = "SELECT * FROM computer WHERE computer_id = ?";
            if($stmt = $conn->prepare($query)) {
                $stmt->bind_param('i', $random);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows == 0) { $used = 0; $this->id = $random; }
                $stmt->close();
            }
        }

        // Insert values into computer table
        $query = "INSERT INTO computer (`computer_id` , `model_id_fk`) VALUES ( ? , ? )" ;
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ii', $this->id , $this->modelId);
            $stmt->execute();
            $stmt->fetch();
            $result[0] = $stmt->affected_rows;
            $stmt->close();
        }
        else echo $conn->error;

        $this->addParts($conn);
    }

    function addParts($conn) {
        // Insert part ids and sub part ids into computer_line table
        if(count($this->parts) > 0) {
            foreach($this->parts as $part) {
                $query = "INSERT INTO computer_line (`computer_id_fk`, `part_id_fk`, `sub_type_id_fk`) VALUES ( ? , ? , ? )";
                if($stmt = $conn->prepare($query)) {
                    $stmt->bind_param('iii', $this->id , $part[0], $part[1]);
                    $stmt->execute();
                    $stmt->fetch();
                    $result[1] = $stmt->affected_rows;
                    echo $conn->error;
                    $stmt->close();
                }
                else echo $stmt->error . $conn->error;
            }
        }

        return $result;

    }

    function updateComputer($conn) {
        $query = "DELETE FROM `computer_line` WHERE `computer_id_fk` = ?";
        if($stmt = $conn->prepare($query)) {            
            $stmt->bind_param('i',$this->id);
            $stmt->execute();
            $stmt->close();            
        }

        $this->addParts($conn);

        $query = "UPDATE computer SET `model_id_fk` = ? WHERE `computer_id_fk = ?";
        if($stmt = $conn->prepare("query")) {
            $stmt->bind_param('ii',$this->modelId, $this->id);
            $stmt->execute();
            $stmt->close();
        } 
    }

    function getComputerParts($conn) {
        $query = "SELECT `part_id_fk`, `sub_type_id_fk` FROM computer_line WHERE `computer_id_fk` = ?";
        if($stmt = $conn->prepare($query)) {
            $stmt->bind_param('i', $this->id);
            $stmt->bind_result($partId, $subTypeId);
            $stmt->execute();
            while ($stmt->fetch()){                
                $part[0] = $partId;
                $part[1] = $subTypeId;
                $parts[] = $part;
            }
            $this->parts = $parts;
            $stmt->close();
            return $this->parts;
        }
        else echo $stmt->error . $conn->error;
    }





}