<?php


class User_Model extends CI_Model
{
    public function get_user_by_name($name)
    {
        $this->db->where("Name", $name);
        $result = $this->db->get("users");
        $result = $result->result_array();
        if(empty($result))
        {
            return false;
        }
        return $result[0];
    }


    public function login($name, $password)
    {
        $this->db->where("Name", $name);

        $result= $this->db->get("users");

        $result = $result->result_array();

        if(empty($result))
            return false;

        $user=$result[0];
        if($user['Password'] != md5($password))
            return false;

        $u_array = array(
            'Id' =>$user['Id'],
            'Name' =>$user['Name']
        );
        return $u_array;
    }

    public function add_user($name, $password, $email)
    {
        $data = array(
            "Name" => $name,
            "Password" => md5($password),
            "Email" => $email
        );
        return $this->db->insert("users", $data);
    }

    public function change_password($name, $password)
    {
        $this->db->where("Name", $name);
        $result= $this->db->get("users");
        $result = $result->result_array();
        if(empty($result))
            return false;
        $user = $result[0];
        $user['password'] = md5($password);
        $this->db->where("Name",$name);
        $this->db->update("users",$user);
        return true;
    }

}