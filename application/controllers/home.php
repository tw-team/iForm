<?php 

class Home extends CI_Controller
{
	public function index()
    {
        if($this->session->userdata('user'))
        {
            $this->load->model("form_model");
            $this->session->set_userdata("forms",$this->form_model->get_all());
		    $this->load->view('home');
        }
        else
        {
            redirect(base_url("user/login"));
        }
	}
}
?>