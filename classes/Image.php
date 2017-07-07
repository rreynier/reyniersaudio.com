<?php
class Image {
	function __construct() {
		$this->id = null;
		$this->imageUrl = null;
		$this->title = null;
		$this->shortDesc = null;
		$this->order = null;
		$this->partId = null;
	}	
	
	function set($imageUrl,$title,$shortDesc,$order,$partId) {		
		$this->imageUrl = $imageUrl;
		$this->title = $title;
		$this->shortDesc = $shortDesc;
		$this->order = $order;
		$this->partId = $partId;
	}
	
	function get($conn,$id) {
		$query = "SELECT * FROM part_img WHERE part_img_id  = ?";
		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param('i',$id);
			$stmt->bind_result(
				$this->id,
				$this->imageUrl,
				$this->title,
				$this->shortDesc,
				$this->order,
				$this->partId
			);		
			$stmt->execute();
			$stmt->fetch();
			$stmt->close();	
		}
	}
	
	function add($conn) {			
		if ($this->imageUrl != null) {
			$query = "INSERT INTO part_img (
						`image_url`,`title`,`short_desc`,`order`,`part_id_fk` ) 
					  VALUES (?,?,?,?,?)";
			if($stmt = $conn->prepare($query)) {
				$stmt->bind_param('sssii',
					$this->imageUrl,
					$this->title,
					$this->shortDesc,
					$this->order,
					$this->partId
				);	
				$stmt->execute();
				$stmt->fetch();					
				$result = $stmt->affected_rows;								
				$stmt->close();	
				
				return $result;					
			}
			else echo $stmt->error.$conn->error;
		}		
	}
	
	function edit($conn) {		
		if ($this->imageUrl != null) {
			$query = "UPDATE `part_img` SET
				`image_url` = ?,
				`title` = ?,
				`short_desc` = ?,
				`order` = ?,
				`part_id_fk` = ?
			  WHERE `part_img_id` = ? ";
			if($stmt = $conn->prepare($query)) {
				$stmt->bind_param('sssiii',
					$this->imageUrl,
					$this->title,
					$this->shortDesc,
					$this->order,
					$this->partId,
					$this->id
				);
				$stmt->execute();
				$stmt->fetch();									
				$stmt->close();										
			}
		}
	}	
	
	function delete($conn) {
		$query = "DELETE FROM part_img WHERE part_img_id = ? ";
		if($stmt = $conn->prepare($query)) {
			$stmt->bind_param('i', $this->id);
			$stmt->execute();			
			$stmt->fetch();
			$result = $stmt->affected_rows;					
			$stmt->close();
			unlink('images/parts/full/' . $this->imageUrl);
			unlink('images/parts/resized/' . $this->imageUrl);
			unlink('images/parts/tn/' . $this->imageUrl);			
			return $result;			
		}
		else {
			echo $conn->error . $stmt->error;
		}			
	}
}
?>

