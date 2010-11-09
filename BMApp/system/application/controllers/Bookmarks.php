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
		$data['resultArray'] = $this->Bookmarks_model->getAll();
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
}
?>