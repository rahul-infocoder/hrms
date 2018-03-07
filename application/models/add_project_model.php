<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Add_Project_Model extends CI_Model{
	
	
	public function insert_project(){
		// $new_name = time().$_FILES["userfile"]['name'];
	$insert=array(
	"title"=>htmlspecialchars($_POST['title'], TRUE),
	"description"=>htmlspecialchars($_POST['des'], TRUE),
	"priority"=>htmlspecialchars($_POST['priority'], TRUE),
	"due_date"=>htmlspecialchars($_POST['dueDate'], TRUE)
	//"file"=>$new_name
	);
	//$xss_data = $this->security->xss_clean($insert);
	//echo xss_clean($insert);
	//print_r($insert);exit;
	$res=$this->db->insert("add_project",$insert);
	$insert_id=$this->db->insert_id();
	//print_r($res);
	return $insert_id;
	
	}
	public function update_image($img,$id){
		$update=array(
		"file"=>$img
		);
		$this->db->where("id",$id);
		$this->db->update("add_project",$update);
		//echo $this->db->last_query();
		return true;
	}
	public function get_project(){
		
		$this->db->select('*');
		$this->db->from('add_project');
		$res=$this->db->get();
		$res=$res->result_array();
		return $res;
	}
	public function project_name($pro){
	$this->db->select("title");
	$this->db->from("add_project");
	$this->db->where("id",$pro);
	$res=$this->db->get();
	$res=$res->row();
	return $res->title;
}
	public function show_project($id){
	$this->db->select("*");
	$this->db->from("assign_project");
	$this->db->where("eid",$id);
	$res=$this->db->get();
	$res=$res->result_array();
	return $res;
	}

	function uploadData()
		{
			
				$count=0;
			$fp = fopen($_FILES['userfile']['tmp_name'],'r') or die("can't open file");
			while($csv_line = fgetcsv($fp,1024))
			{
				$count++;
				if($count == 1)
				{
					continue;
				}//keep this if condition if you want to remove the first row
				for($i = 0, $j = count($csv_line); $i < $j; $i++)
				{
					$insert_csv = array();
					$insert_csv['Name'] = $csv_line[0];//remove if you want to have primary key,
					$insert_csv['Emp_id'] = $csv_line[1];
					$insert_csv['Designation'] = $csv_line[2];
					$insert_csv['Email_id'] = $csv_line[3];
					$insert_csv['Password'] = $csv_line[4];
					$insert_csv['Emergency_Number'] = $csv_line[5];
					$insert_csv['Date_of_Birth'] = $csv_line[6];
					$insert_csv['Joining_Date'] = $csv_line[7];
					$insert_csv['Department'] = $csv_line[8];
					$insert_csv['Gender'] = $csv_line[9];
					$insert_csv['Contact_No'] = $csv_line[10];
					$insert_csv['Address'] = $csv_line[11];

				}
				$i++;
				//print_r($insert_csv);
				$data = array(
					'Name' =>$insert_csv['Name'],
					'Emp_id' => $insert_csv['Emp_id'],
					'Designation' => $insert_csv['Designation'],
					'Email_id' => $insert_csv['Email_id'],
					'Password' => $insert_csv['Password'],
					'Emergency_Number' => $insert_csv['Emergency_Number'],
					'Date_of_Birth' => $insert_csv['Date_of_Birth'],
					'Joining_Date' => $insert_csv['Joining_Date'],
					'Department' => $insert_csv['Department'],
					'Gender' => $insert_csv['Gender'],
					'Contact_No' => $insert_csv['Contact_No'],
					'Address' => $insert_csv['Address']
				   );
				$data['crane_features']=$this->db->insert('add_user', $data);
			}
			fclose($fp) or die("can't close file");
			$data['success']="success";
			return $data;
		}
		public function decribe_project($id){
			$this->db->select("*");
			$this->db->from("add_project");
			$this->db->where("id",$id);
			$res=$this->db->get();
			$res=$res->result_array();
			return $res;			
		}
		
		public function startTime($data){
			// if(!$data['pid'] && !$data['eid']){}
			$insert=array(
			"pid" => $data['pid'],
			"eid" => $data['eid'],
			"start" =>$data['time']
			);
			$res=$this->db->insert("start_time",$insert);
			return($res);
		}
		public function inputpausetime($data){
			$update=array(
			"pause" =>$data['time']
			);
			$this->db->update("start_time",$update);
			$this->db->where("pid",$data['pid']);
			$this->db->where("eid",$data['eid']);
			return true;
		}
		public function updatestartTime($data){
			$update=array(
			"start" =>$data['time']
			);
			$this->db->update("start_time",$update);
			$this->db->where("pid",$data['pid']);
			$this->db->where("eid",$data['eid']);
			return true;
		}
		public function project_time($data){
		 $this->db->select('start,pause');
		 $this->db->from('start_time');
		 $this->db->where('pid',$data['pid']);
		 $this->db->where('eid',$data['eid']);
		 $date =$this->db->get();
		 $date =$date->result_array();
		 $from_time=strtotime(date('H:i:s', strtotime($date[0]['start'])));
		 //$from_time=strtotime($date[0]['start']);
		 $to_time=strtotime(date('H:i:s', strtotime($date[0]['pause'])));
		 //print_r($from_time);
		 $minutes= round(abs($from_time - $to_time) / 60,2);
		 //print_r($minutes);
		  $update=array("working_minutes"=>$minutes);
		  $this->db->where('pid',$data['pid']);
		  $this->db->where('eid',$data['eid']);
		  $res=$this->db->update('start_time',$update);
		  return $res;
		}
}
?>