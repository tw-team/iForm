<?php
require_once 'application/libraries/quickstart.php';
class form_page extends CI_Controller
{
    public function is_logged()
    {
        if($this->session->userdata('user'))
            return true;
        return false;
    }

    public function create()
    {
        if(!$this->is_logged())
        {
            redirect(base_url('home'));
        }
        $this->load->view("newForm");
    }

    public function preview()
    {
        $this->session->set_userdata('form',$this->input->post('form'));
        $this->load->view('preview_form');
    }
public function about(){
     $this->load->view('about');
}
    public function store()
    {
        $this->load->model("form_model");
        $this->form_model->add($this->input->post('title'),$this->input->post('form'));
    }

    public function show()
    {
        $this->session->unset_userdata('form');
		$this->session->unset_userdata('token');
        $this->load->model("form_model");
        $token = $this->input->get('token');
		$this->session->set_userdata("token",$token);
        $data = $this->form_model->get($token);
        if($data==false or $token == '')
        {
            $data["heading"] = "404 Page Not Found";
            $data["message"] = "The page you requested was not found ";
            $this->load->view('error_404',$data);
            return;
        }
        $data = $data[0]['content'];
        $this->session->set_userdata('form',$data);
        $this->load->view('show_form');
    }

    public function save_answers()
    {
        $this->load->model("form_model");
        $id = $this->form_model->generate_token();
        $token = $this->input->post('token');
        $answers = $this->input->post('answers');
        $file = fopen('assets/xmlFiles/'.$id,'w');
        fwrite($file,$answers);
        fclose($file);
        $obj1 = new WindowsAzureCloudProcessing();
        $obj1->containerCreator($token);
        $obj1->uploadFile($token, "assets/xmlFiles/".$id,$id);
        unlink('assets/xmlFiles/'.$id);
    }

    public function show_results()
    {
        $token = $this->input->post('token');
        $this->load->model("form_model");
        if(! $this->form_model->get($token))
        {
            $data["heading"] = "404 Page Not Found";
            $data["message"] = "Invalid token";
            return;
        }
        $obj1 = new WindowsAzureCloudProcessing();
        $res = $obj1->downloadBlobs($token);
        echo '{"head":';
        echo $this->form_model->get($token)[0]['content'];
        echo ',"result":';
        if(!empty($res))
            echo "[".implode($res,",")."]";
        else
            echo "[]";
        echo '}';
    }

    public function delete()
    {
        $token = $this->input->post('token');
        $this->load->model("form_model");
        $result = $this->form_model->delete($token);
        if($result == 1)
        {
            $obj1 = new WindowsAzureCloudProcessing();
            $obj1->deleteBlobs($token);
            return;
        }
        echo "fail";
    }
}