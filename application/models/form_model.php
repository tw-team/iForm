<?php


class Form_Model extends CI_Model
{
    public function add($name,$content)
    {
        $data = array(
            "id" => $this->get_id(),
            "user" => $this->session->userdata["user"]["Id"],
            "title" => $name,
            "content" => $content,
            "token" => $this->generate_token()
        );
        return $this->db->insert("form", $data);
    }

    public function get_id()
    {
        $query = $this->db->query('SELECT max(ID) as maxid FROM form');
        $row = $query->row();
        return $row->maxid+1;
    }

    public function generate_token()
    {
        $charset = "abcdefghijklmnopqrstuvwxyz1234567890";
        $token= NULL;
        for($x=1;$x <= 20; $x++)
        {
            $rand= rand() % strlen($charset);
            $temp= substr($charset, $rand, 1);
            $token= $token . $temp;
        }
        return  $token.strval(time());


    }

    public function get_all()
    {
        $query = $this->db->query('SELECT title,token FROM form WHERE user ='.$this->session->userdata["user"]["Id"]);
        return $query->result();
    }

    public function get($token)
    {
        $this->db->where("token", $token);
        $result= $this->db->get("form");
        $result = $result->result_array();
        if(empty($result))
            return false;
        return $result;
    }

    public function delete($token)
    {
        $this->db->where("token", $token);
        $this->db->where("user",$this->session->userdata["user"]["Id"]);
        return $this->db->delete("form");
    }
}