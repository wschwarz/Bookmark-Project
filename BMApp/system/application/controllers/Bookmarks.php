<?php
class Bookmarks extends Controller {
	function index() 
	{
		$this->load->view('bookmarks');
		//$this->LoadBookmarks();
	}
	
	function RemoveEntry() {
		$this->Bookmarks_model->delete_entry($this->input->post('id'));
		echo $this->input->post('id');
	}
	
	function LoadBookmarks() {
		$data['resultArray'] = array();
		//$data['resultArray'] = $this->Bookmarks_model->getAll();
		if ($this->session->userdata('page') && $this->session->userdata('pageSize') && $this->session->userdata('totalEntries')) {
			if ($this->input->post('pageDirection') == 'forward' && (($this->session->userdata('page') + 1) * $this->session->userdata('pageSize')) < $this->session->userdata('totalEntries')) {
				$data['resultArray'] = $this->Bookmarks_model->getAll($this->session->userdata('page') + 1, $this->session->userdata('pageSize'));
				$this->session->set_userdata(array('page' => $this->session->userdata('page') + 1));
			}
			else if ($this->input->post('pageDirection') == 'back' && ($this->session->userdata('page') - 1) > 0) {
				$data['resultArray'] = $this->Bookmarks_model->getAll($this->session->userdata('page') - 1, $this->session->userdata('pageSize'));
				$this->session->set_userdata(array('page' => $this->session->userdata('page') - 1));
			}
			else {
				$data['resultArray'] = $this->Bookmarks_model->getAll($this->session->userdata('page'), $this->session->userdata('pageSize'));
			}
		}
		else {
			$this->session->set_userdata(array('page' => 1));
			$this->session->set_userdata(array('pageSize' => 20));
			$this->session->set_userdata(array('totalEntries' => $this->Bookmarks_model->getTotal()));
			$data['resultArray'] = $this->Bookmarks_model->getAll($this->session->userdata('page'), $this->session->userdata('pageSize'));
		}
		$this->load->view('listTemplate', $data);
	}
	
	function SortBookmarks() {
		if ($this->input->post('field')) {
			$data['resultArray'] = $this->Bookmarks_model->getAllSort($this->input->post('field'), $this->input->post('direction'));
			$this->load->view('listTemplate', $data);	
		}
		else if ($this->input->get('field')) {
			$field = $this->input->get('field');
			switch ($field)
				{
					case 'date added': {
						$field = 'add_date';
						break;
					}	
					case 'last modified': {
						$field = 'last_modified';
						break;
					}
					default:
						break;
				}
			$data['resultArray'] = $this->Bookmarks_model->getAllSort($field, $this->input->get('direction'));
			$this->load->view('listTemplate', $data);
		}
	}
	
	function Query() {
		if ($this->input->post('query')) {
			$data['resultArray'] = $this->Bookmarks_model->query($this->input->post('query'));
			$this->load->view('listTemplate', $data);
		}
		else if ($this->input->get('query')) {
			$data['resultArray'] = $this->Bookmarks_model->query($this->input->get('query'));
			$this->load->view('listTemplate', $data);
		}
		else {
			$data['resultArray'] = $this->Bookmarks_model->getAll();
			$this->load->view('listTemplate', $data);
		}
	}
	
	function SetRead() {
		if ($this->input->post('id')) {
			print_r($this->Bookmarks_model->toggleRead($this->input->post('id')) . " was changed.");
		}
		else if ($this->input->get('id')) {
			print_r($this->Bookmarks_model->toggleRead($this->input->get('id')) . " was changed.");
		}
		else {
			print_r("Controller error occurred");
		}
	}
}
?>