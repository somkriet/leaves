<?php

class Upload extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_upload');
	}
	function do_upload()
	{
		$config['upload_path'] = '../leaves/uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']	= '1024';
		$namefile=date('ymdhms').'pdf';
		$config['file_name'] = $namefile;
		$data['row_start_date']=$this->input->post('row_start_date');
		$data['row_end_date']=$this->input->post('row_end_date');
		$data['row_user_ID']=$this->input->post('row_user_ID');

		$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				redirect('leave/leave_detail/1/'.$data['row_start_date']."/".$data['row_end_date']."/".$data['row_user_ID'],'refresh');
				exit();
			}
				else
			{
				$data = array('upload_data' => $this->upload->data());
			}
				$config1['image_library'] = 'gd2';
		        $config1['source_image'] = '../leaves/uploads/'.$namefile;  
		        $config1['create_thumb'] = FALSE;
		        $config1['new_image'] = '../leaves/uploads/'.$namefile;
		        $config1['maintain_ratio'] = FALSE;
		        $this->load->library('image_lib', $config1); 
		        $this->image_lib->resize();
		$data['namefile']=$namefile;
		$data['leave_ID']=$this->input->post('leave_ID');
		$this->m_upload->update_upload($data);        
        redirect('leave/leave_detail/2/'.$data['row_start_date']."/".$data['row_end_date']."/".$data['row_user_ID'],'refresh');
	}
}
?>