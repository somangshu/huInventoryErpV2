<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use MetzWeb\Instagram\Instagram;

class site extends CI_Controller 
{	
	public function hash()
	{
		$this->load->model("enterprisesmodel");
		
		$images = array();
		$data['title'] = "Images";
		
		require_once 'api/src/Instagram.php';
		
		$this->load->library('session');
		$sessionUserData = $this->session->all_userdata();
		$displayData['sessionUserData']=$sessionUserData;
	
		$instagram = new Instagram(INSTA_KEY);
		$tag = 'happilyunmarried';
		
		$media = $instagram->getTagMedia($tag, 20);
		
		$result = 0;
		$limit = 20;
		$size = '320';
		$loop = 0;

		$username = array();
		$count = 0;

		$imageids = $this->enterprisesmodel->getimageids();
		
		try 
		{
			do 
			{
				$tuple = 'INSERT into insta_images (imageurl, likes, username, source, imageid, caption) VALUES ';
				$query1 = 'INSERT into tags (imageid, tag) VALUES ';
				$query2 = 'INSERT into statustable (imageid, status) VALUES ';
				$query3 = 'INSERT into insta_users (username, profile) VALUES ';
				foreach(array_slice($media->data, 0, $limit) as $imagedata)
				{
					$flag = 0;
					if(!isset($imagedata->caption->id))
					{	
						echo $imagedata->images->standard_resolution->url;
						continue;
					} 

        			$tuple .= "(";
					$tuple .= '"'.$imagedata->images->standard_resolution->url.'"';
					$tuple .= ', "'.$imagedata->likes->count;
					
					if(isset($imagedata->caption->from->username))
						$tuple .= '", "'.$imagedata->caption->from->username;
					else 
						$tuple .= '", "NO USERNAME FOUND';
					
					$tuple .= '", "web"';
					$tuple .= ', "'.$imagedata->caption->id.'"';

					$caption = mysql_real_escape_string($imagedata->caption->text);
					$tuple .= ', "'.$caption.'"';
					$tuple .= "), ";
					
					foreach($imagedata->tags as $tagname)
					{

						$query1 .= "(";
						$query1 .= '"'.$imagedata->caption->id.'"';
						$query1 .= ', "'.$tagname.'"';
						$query1 .= "), ";
					}

					$query2 .= "(";
					$query2 .= '"'.$imagedata->caption->id.'"';
					$query2 .= ', "active"';
					$query2 .= "), ";

					if(!in_array($imagedata->caption->from->username, $username))
					{
						$flag = 1;

						$query3 .= "(";
						$query3 .= '"'.$imagedata->caption->from->username.'"';
						$query3 .= ', "'.$imagedata->caption->from->profile_picture.'"';
						$query3 .= "), ";

						$username[$count++] = $imagedata->caption->from->username;
					}
				}

				$sub = strrchr($tuple, ",");
				$tuple = trim($tuple, $sub);
				$tuple .= ";";

				$sub = strrchr($query1, ",");
				$query1 = trim($query1, $sub);
				$query1 .= ";";

				$sub = strrchr($query2, ",");
				$query2 = trim($query2, $sub);
				$query2 .= ";";

				$sub = strrchr($query3, ",");
				$query3 = trim($query3, $sub);
				$query3 .= ";";

				$which = 0;

				$result = $this->enterprisesmodel->insertInstagramImages($tuple);
				if($result)
				{
					$which = 1;
					$result = $this->enterprisesmodel->insertInstagramImages($query1);
					if($result)
					{
						$which = 2;
						$result = $this->enterprisesmodel->insertInstagramImages($query2);
						if($result && $flag)
						{
							$which = 3;
							$result = $this->enterprisesmodel->insertInstagramImages($query3);
						}
					}
				}
				
				if(!$result)
				{
					print_r("Error in insert to db. ".$which);
				 	die();
				}
				
				if(isset($media->pagination->next_max_id))
				{
					$media = $instagram->pagination($media, $limit);
				}
				else
				{
					$this->enterprisesmodel->insertnexturl($media->pagination->next_min_id);	
					break;
				}		
			}while(count($media->data) > 0);
		}
		catch(Exception $e)
		{
			echo "<h1><b>EXCEPTION</b></h1>".$e;
			die();
		}
	}

	public function displayimages($page)
	{
		$this->load->model("enterprisesmodel");
		
		$images = array();

		$this->load->library('session');
		$sessionUserData = $this->session->all_userdata();
		$data['sessionUserData']=$sessionUserData;
		$data['menuPanelsArray']=$this->enterprisesmodel->getAllPanelsByRole($sessionUserData['user_role_id']);
		$data['imagedata'] = $this->enterprisesmodel->pagination($page);
		$data['imagedata']['page'] = $page;
		$data['url'] = 'displayimages';
		$data['search'] = 0;
		$data['flag'] = 1;

		$this->load->view("images", $data);
	}

	public function updateimages()
	{
		$this->load->model("enterprisesmodel");
		$this->load->library('session');
		
		$sessionUserData = $this->session->all_userdata();
		
		$data['sessionUserData']=$sessionUserData;
		$data['menuPanelsArray']=$this->enterprisesmodel->getAllPanelsByRole($sessionUserData['user_role_id']);
		
		$this->load->view("/instagram/gettag", $data);
	}

	public function updateimagesfromtag()
	{
		$this->load->model("enterprisesmodel");

		require_once 'api/src/Instagram.php';
		
		$this->load->library('session');
		$sessionUserData = $this->session->all_userdata();
		$displayData['sessionUserData']=$sessionUserData;
				
		$instagram = new Instagram(INSTA_KEY);
		$tag = $_POST['tag'];
		$limit = 20;
		
		$media = $instagram->getTagMedia($tag, $limit);
	
		$imageids = $this->enterprisesmodel->getimageids();

		$result = 0;
		$size = '320';
		$loop = 0;

		try 
		{
			do 
			{
				$tuple = 'INSERT into insta_images (imageurl, likes, username, source, imageid) VALUES ';
				$query1 = 'INSERT into tags (imageid, tag) VALUES ';
				$query2 = 'INSERT into statustable (imageid, status) VALUES ';
				$query3 = 'INSERT into insta_users (username, profile) VALUES ';
				foreach(array_slice($media->data, 0, $limit) as $imagedata)
				{
					if(!isset($imagedata->caption->id))
					{	
						echo $imagedata->images->standard_resolution->url;
						continue;
					}

					if(in_array($imagedata->caption->id, $imageids))
						break;

					
        			$tuple .= "(";
					$tuple .= '"'.$imagedata->images->standard_resolution->url.'"';
					$tuple .= ', "'.$imagedata->likes->count;
					
					if(isset($imagedata->caption->from->username))
						$tuple .= '", "'.$imagedata->caption->from->username;
					else 
						$tuple .= '", "NO USERNAME FOUND';
					
					$tuple .= '", "web"';
					$tuple .= ', "'.$imagedata->caption->id.'"';
					$tuple .= "), ";
					
					foreach($imagedata->tags as $tagname)
					{

						$query1 .= "(";
						$query1 .= '"'.$imagedata->caption->id.'"';
						$query1 .= ', "'.$tagname.'"';
						$query1 .= "), ";
					}

					$query2 .= "(";
					$query2 .= '"'.$imagedata->caption->id.'"';
					$query2 .= ', "active"';
					$query2 .= "), ";

					$query3 .= "(";
					$query3 .= '"'.$imagedata->caption->from->username.'"';
					$query3 .= ', "'.$imagedata->caption->from->profile_picture.'"';
					$query3 .= "), ";
				}

				$sub = strrchr($tuple, ",");
				$tuple = trim($tuple, $sub);
				$tuple .= ";";

				$sub = strrchr($query1, ",");
				$query1 = trim($query1, $sub);
				$query1 .= ";";

				$sub = strrchr($query2, ",");
				$query2 = trim($query2, $sub);
				$query2 .= ";";

				$sub = strrchr($query3, ",");
				$query3 = trim($query3, $sub);
				$query3 .= ";";

				$result = $this->enterprisesmodel->insertInstagramImages($tuple);
				if($result)
				{
					$result = $this->enterprisesmodel->insertInstagramImages($query1);
					if($result)
					{
						$result = $this->enterprisesmodel->insertInstagramImages($query2);
						if($result)
							$result = $this->enterprisesmodel->insertInstagramImages($query3);
					}
				}
				
				if(!$result)
				{
					print_r("Error in insert to db.");
				 	die();
				}
				
				if(isset($media->pagination->next_max_id))
				{
					$media = $instagram->pagination($media, $limit);
				}
				else
				{
					$this->enterprisesmodel->insertnexturl($media->pagination->next_min_id);	
					break;
				}		
			}while(count($media->data) > 0);
		}
		catch(Exception $e)
		{
			echo "<h1><b>EXCEPTION</b></h1>".$e->$message;
			die();
		}
		$this->displayimages(1);
	}

	public function searchimages()
	{
		$this->load->model("enterprisesmodel");
		$this->load->library('session');
		require_once('calendar/classes/tc_calendar.php');
		$sessionUserData = $this->session->all_userdata();
		
		$data['search'] = 1;
		$data['flag'] = 0;

		$data['sessionUserData']=$sessionUserData;
		$data['menuPanelsArray']=$this->enterprisesmodel->getAllPanelsByRole($sessionUserData['user_role_id']);

		$data['json'] = $this->letsjson();
		$data['array'] = $this->letsarray();

		$this->load->view("images", $data);
	}

	public function getimages($page)
	{
		$post['tag'] = $_POST['tag'];
		$post['source'] = $_POST['source'];
		$post['date'] = $_POST['date'];
		if(isset($_POST['categories']))
			$post['categories'] = $_POST['categories'];
		if(isset($_POST['subcategories']))
			$post['subcategories'] = $_POST['subcategories'];

		$this->load->model("enterprisesmodel");
		$this->load->library('session');
		$sessionUserData = $this->session->all_userdata();
		
		$data['sessionUserData']=$sessionUserData;
		$data['menuPanelsArray']=$this->enterprisesmodel->getAllPanelsByRole($sessionUserData['user_role_id']);
		
		$data['imagedata'] = $this->enterprisesmodel->getSearchImages($post, $page);
		$data['imagedata']['page'] = $page;
		$data['url'] = 'getimages';
		$data['post'] = $post;
		$data['flag'] = 1;
		$data['search'] = 1;
		if($data['imagedata'] != 'false')
			$this->load->view("/images", $data);
		else
			echo 'No new images!';
	}

	public function imageinfo($id)
	{
		$this->load->model("enterprisesmodel");
		$this->load->library('session');
		$sessionUserData = $this->session->all_userdata();
		$data['sessionUserData']=$sessionUserData;
		$data['menuPanelsArray']=$this->enterprisesmodel->getAllPanelsByRole($sessionUserData['user_role_id']);
		
		$data['info'] = $this->enterprisesmodel->getImageInfo($id);
		$data['json'] = $this->letsjson();
		$data['array'] = $this->letsarray();
		
		$this->load->view("/instagram/imageinfo", $data);
	}

	public function vidisha()
	{
		//$this->enterprisesmodel->insertstatus();		
		$result = "";
		$arr = [1, 3, 5, 7, 9, 11, 13, 15];
		for($i=0; $i<count($arr); $i++)
		{
			for($j=0; $j<count($arr); $j++)
			{
				for($k=0; $k<count($arr); $k++)
				{
					$sum = $arr[$i] + $arr[$j] + $arr[$k];
					if($sum == 30)
						$result = $result.$i.",".$j.",".$k."; "; 
				}
			}
		}
		$data['result'] = $result;
		$this->load->view("vidisha", $data);	
	}

	public function letsjson()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
    								CURLOPT_RETURNTRANSFER => 1,
    								CURLOPT_URL => 'http://203.124.120.89/api/store/categorylist?secretkey=XmgobA7HyvrBLhjI74o5pqec2fDFSf4TWzmIhSYnkNU',//CHANGE THIS WHEN AFTER STAGING
    								));
		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}

	public function letsarray()
	{
		$result = $this->letsjson();
		
		$json = (json_decode($result, true));
		return $json;	
	}

	public function updatethisimage()
	{
		$this->load->model("enterprisesmodel");

		$data['temp1'] = $_POST['categorytags'];
		$data['temp2'] = $_POST['subcategorytags'];
		$data['temp3'] = $_POST['consumertypetags'];
		$data['temp4'] = $_POST['manualtags'];
		$data['id'] = $_POST['imageid'];

		$data['info'] = $this->enterprisesmodel->updatethisimage($data);
	}
}