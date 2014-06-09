<?php

if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}

class User extends CI_Controller
{
    protected function is_logged()
    {
        if($this->session->userdata('user'))
            return true;
        return false;
    }

    public function login()
    {
        if($this->is_logged())
            redirect(base_url("home"));
        //Check request method
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $username = $this->input->post('Name');
            $password = $this->input->post('Password');
            $this->load->model('user_model');
            //Check valid user-pass
            if($user= $this ->user_model->login($username,$password))
            {
                //set session var and redirect to HOME
                $this->session->set_userdata('user',$user);
                redirect(base_url("home"));
            }
            else
            {
                $this->session->set_userdata('error','Invalid username or password');
            }

        }
        //Show the login page
        $this->load->view('login');
    }

    public function logout()
    {
        //Remove session var
        $this->session->unset_userdata("user");
        redirect(base_url("home"));
    }

    public function recovery()
    {
        if($this->is_logged())
            redirect(base_url("home"));

        //Check if method is POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $name=$_POST['Name'];
            $email=$_POST['Email'];

            //Check if both user and email were given
            if($name && $email)
            {
                $this->load->model("user_model");
                $user = $this->user_model->get_user_by_name($name );

                //check if is valid user/email combination
                if(!$user or $user['Email']!=$email)
                {
                    $this->session->set_userdata("message","Invalid user or email");
                }
                else
                {
                    //create a random password
                    $charset = "abcdefghijklmnopqrstuvwxyz1234567890";
                    $password= NULL;
                    for($x=1;$x <= 15; $x++)
                    {
                        $rand= rand() % strlen($charset);
                        $temp= substr($charset, $rand, 1);
                        $password = $password . $temp;
                    }

                    //change the password in DB
                    if($this->user_model->change_password($name,$password))
                    {
                        $this->load->library("utils");
                        //Send mail with the new password
                        if($this->utils->send_recovery_mail($user ["Name"],$email,$password))
                        {
                            //if all ok, redirect to home
                            redirect(base_url("home"));
                        }
                    }
                    else
                    {
                        $this->session->set_userdata("message","Internal server error. Please try again.");
                    }
                }
            }
            else
            {
                $this->session->set_userdata("message","You must enter both, Name and Email!");
            }
        }
        $this->load->view('recover');
    }

    public function change_password()
    {
        if(! $this->is_logged())
            redirect(base_url("home"));

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->load->view('change_password');
            return;
        }

        $this->form_validation->set_rules('cur_pw','Current Password','required|callback_pass_check');
        $this->form_validation->set_rules('new_pw','New Password','required|max_length[20]|min_length[6]');
        $this->form_validation->set_rules('conf_pw','Confirm Password','required|matches[new_pw]');

        $this->form_validation->set_message('pass_check','Invalid old password');

        if($this->form_validation->run() != true)
        {
            $this->load->view('change_password');
            return;
        }

        $user = $this->session->userdata("user")['Name'];
        $new_pass = $this->input->post("new_pw");
        $this->load->model("user_model");

        $this->user_model->change_password($user,$new_pass);
        $this->session->set_userdata('message','Password changed successfully');
        $this->load->view('home');
    }

    public function register()
    {
        if($this->is_logged())
            redirect(base_url('home'));

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->load->view('register');
            return;
        }

        $this->form_validation->set_rules("Name","Name","required|callback_verify_username|min_length[3]|max_length[20]");
        $this->form_validation->set_rules("Password","Password","required|min_length[6]|max_length[20]");
        $this->form_validation->set_rules("Email","Email","required|valid_email");
        $this->form_validation->set_rules("captcha", "Captcha", "required|callback_verify_captcha");

        $this->form_validation->set_message("verify_captcha", "Incorrect Captcha");
        $this->form_validation->set_message("verify_username", "Username already in use");

        if($this->form_validation->run()==FALSE)
        {
            $this->load->view('register');
            return;
        }

        $name= $this->input->post("Name");
        $password= $this->input->post("Password");
        $email=$this->input->post("Email");

        $this->load->model('user_model');

        if($this->user_model->add_user($name, $password, $email))
        {
            $user = array(
                'Id' => $this->db->insert_id(),
                'Name' => $name
            );
            $this->session->set_userdata('user',$user);
            $this->session->set_userdata('message','Account successfully created');
            redirect(base_url("home"));
        }
        $this->session->set_userdata('message','Internal server error. Please try again.');
        $this->load->view('register');
    }

    public function captcha()
    {
        $this->load->library('utils');
        $this->utils->captcha();
    }

    public function verify_captcha($captcha)
    {
        return $captcha == $_SESSION['6_letters_code'];
    }

    public function verify_username($name)
    {
        $this->load->model("user_model");
        $categories = $this->user_model->get_user_by_name($name);
        return empty($categories);
    }

    public function pass_check($pass)
    {
        $this->load->model("user_model");
        $user = $this->session->userdata("user")['Name'];
        if($this->user_model->login($user,$pass))
            return true;
        return false;
    }
}
?>