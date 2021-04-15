<?php

class Post{
	private $conn;
	private $table = 'tbltask';

	public $rowstamp;
	public $taskid;
	public $task;
	public $details;
	public $status;
	public $deadline;
	public $movecount;

	//db connection
	public function __construct($db){
		$this->conn = $db;

	}

	//getting post from db
	public function listTask(){

		$query = 'SELECT 
			p.rowstamp as rowstamp,
			p.taskid,
			p.task,
			p.details,
			p.status,
			p.deadline,
			p.movecount,
			p.taskorder
			FROM 
			'.$this->table.' p
			ORDER BY p.taskorder ASC';

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	//search by taskid
	public function searchTask(){
		$query = 'SELECT 
			c.rowstamp as rowstamp,
			p.taskid,
			p.task,
			p.details,
			p.status,
			p.deadline,
			p.movecount
			FROM 
			'.$this->table.' p
			LEFT JOIN 
				tblTask c ON p.taskid = c.taskid
				WHERE p.taskid = ? LIMIT 1';

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1,$this->taskid);

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->taskid 		= $row['taskid'];
		$this->task 		= $row['task'];
		$this->details 		= $row['details'];
		$this->status 		= $row['status'];
		$this->deadline 	= $row['deadline'];
		$this->movecount 	= $row['movecount'];
	}

	//creating task
	public function insertTask(){
		//insert query
		$query = 'INSERT INTO '.$this->table.' SET taskid = :taskid, task = :task, details = :details, status = :status, deadline= :deadline, movecount=0;';
		//prepare statement
		$stmt = $this->conn->prepare($query);

		//clean
		//$this->rowstamp 	= htmlspecialchars(strip_tags($this->rowstamp));
		$this->taskid 		= htmlspecialchars(strip_tags($this->taskid));
		$this->task 		= htmlspecialchars(strip_tags($this->task));
		$this->details 		= htmlspecialchars(strip_tags($this->details));
		$this->status 		= htmlspecialchars(strip_tags($this->status));
		$this->deadline 	= htmlspecialchars(strip_tags($this->deadline));
		//$this->movecount	= htmlspecialchars(strip_tags($this->movecount));
		
		//binding parameters
		//$stmt->bindParam(':rowstamp',$this->rowstamp);
		$stmt->bindParam(':taskid',$this->taskid);
		$stmt->bindParam(':task',$this->task);
		$stmt->bindParam(':details',$this->details);
		$stmt->bindParam(':status',$this->status);
		$stmt->bindParam(':deadline',$this->deadline);
		//$stmt->bindParam(':movecount',$this->movecount);

		//execute the query
		if($stmt->execute()){
			return true;
		}

		//show error
		printf("Error %s. \n", $stmt->error);
		return false;
	}

	//update task details
	public function updateTask(){
		//update query
		$query = 'UPDATE '.$this->table.' SET task = :task, details = :details, status = :status
		WHERE rowstamp = :rowstamp';
		//prepare statement
		$stmt = $this->conn->prepare($query);

		//clean
		$this->rowstamp 	= htmlspecialchars(strip_tags($this->rowstamp));
		$this->task 		= htmlspecialchars(strip_tags($this->task));
		$this->details 		= htmlspecialchars(strip_tags($this->details));
		$this->status 		= htmlspecialchars(strip_tags($this->status));
		
		//binding parameters
		$stmt->bindParam(':rowstamp',$this->rowstamp);
		$stmt->bindParam(':task',$this->task);
		$stmt->bindParam(':details',$this->details);
		$stmt->bindParam(':status',$this->status);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}

		//show error
		printf("Error %s. \n", $stmt->error);
		return false;
	}

	//delete/remove task
	public function removeTask(){
		//delete query
		$query = 'DELETE FROM '.$this->table.' WHERE rowstamp = :rowstamp';
		//prepare statement
		$stmt = $this->conn->prepare($query);

		//clean and bind parameters
		$this->rowstamp 	= htmlspecialchars(strip_tags($this->rowstamp));
		$stmt->bindParam(':rowstamp',$this->rowstamp);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}

		//show error
		printf("Error %s. \n", $stmt->error);
		return false;
	}

	//update task
	public function moveTask(){
		//move query
		//can update more than 50 with numbers of move to monitor
		$query = 'CALL moveTasks(:rowstamp,:moveTo,:deadline);';
		//prepare statement
		$stmt = $this->conn->prepare($query);

		//clean
		$this->rowstamp 	= htmlspecialchars(strip_tags($this->rowstamp));
		$this->moveTo 		= htmlspecialchars(strip_tags($this->moveTo));
		$this->deadline 	= htmlspecialchars(strip_tags($this->deadline));

		//binding parameters
		$stmt->bindParam(':rowstamp',$this->rowstamp);
		$stmt->bindParam(':moveTo',$this->moveTo);
		$stmt->bindParam(':deadline',$this->deadline);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}

		//show error
		printf("Error %s. \n", $stmt->error);
		return false;
	

	}

}
?>
