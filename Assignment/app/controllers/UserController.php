<?php
class UserController {
	private $slimApp;
	private $model;
	private $requestBody;
	
	public function __construct($model, $action = null, $slimApp, $parameteres = null) {
		$this->model = $model;
		$this->slimApp = $slimApp;
		$this->requestBody = json_decode($this->slimApp->request->getBody(), true);		//this must contain the representation of the new user
		
		$id = $parameteres["id"];
		if ($action != null) {
			switch ($action) {
				case ACTION_GET_USER :
					$this->getUser ();
					break;
				case ACTION_GET_USERS :
					$this->getUsers ();
					break;
				case ACTION_UPDATE_USER :
					$this->updateUser ($id, $this->requestBody);
					break;
				case ACTION_CREATE_USER :
					$this->createNewUser ($this->requestBody);
					break;
				case ACTION_DELETE_USER :
					$this->deleteUser ($id);
					break;
				
				default :
			}
		}
	}
	private function getUsers() {
		$answer = $this->model->getUsers ();
		if ($answer != null) {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_OK );
			$this->model->apiResponse = $answer;
		} else {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_NOCONTENT );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_NOCONTENT_MESSAGE 
			);
			$this->model->apiResponse = $Message;
		}
	}
	private function getUser() {
	}
	private function updateUser() {
	}
	private function createNewUser($newUser) {
		
		if ($newID = $this->model->createNewUser($newUser)){
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_CREATED );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_RESOURCE_CREATED ,
					"id" => "$newID"
			);
			$this->model->apiResponse = $Message;
		}
		else {
			$this->slimApp->response ()->setStatus ( HTTPSTATUS_BADREQUEST );
			$Message = array (
					GENERAL_MESSAGE_LABEL => GENERAL_INVALIDBODY
			);
			$this->model->apiResponse = $Message;
		}
	}
	private function deleteUser() {
	}
}
?>