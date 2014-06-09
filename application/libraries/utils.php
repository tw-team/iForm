<?php

class Utils extends CI_Controller
{
    public function send_recovery_mail($name,$email,$password)
    {
        require_once "Mail.php";
        //$password = implode('',$password);
        $from     = "<no.reply.iform@gmail.com>";
        $to       = "<$email>";
        $subject  = "iForm Password Recovery";
        $body     =
"Hello $name,\n

    You have recently requested a new password at iForm.
    We recommend you to change this password as soon as you log in.\n

    Your new password is : \n
    $password\n

    Best regards,
        iForm Team.";

        $host     = "ssl://smtp.gmail.com";
        $port     = "465";
        $username = "no.reply.iform@gmail.com";  //<> give errors
        $password = "tehnologiiweb";

        $headers = array(
            'From'    => $from,
            'To'      => $to,
            'Subject' => $subject
        );
        $smtp = Mail::factory('smtp', array(
            'host'     => $host,
            'port'     => $port,
            'auth'     => true,
            'username' => $username,
            'password' => $password
        ));

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail))
        {
            $this->session->set_userdata("message","Mail cannot be send. Please try again.");
            return false;
        }
        else
        {
            $this->session->set_userdata('message','Message successfully sent!');
            return true;
        }
    }

    public function captcha()
    {
        $image_width = 100;
        $image_height = 50;
        $characters_on_image = 6;
        $font = 'Moshka.otf';

        //The characters that can be used in the CAPTCHA code.
        //avoid confusing characters (l 1 and i for example)
        $possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
        $captcha_text_color="0x272727";
        $captcha_noice_color = "0x142864";

        $code = '';

        $i = 0;
        while ($i < $characters_on_image)
        {
            $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
            $i++;
        }

        $font_size = $image_height * 0.50;
        $image = @imagecreate($image_width, $image_height);

        /* setting the background, text and noise colours here */
        imagecolorallocate($image, 255, 255, 255);

        $arr_text_color = $this->hexrgb($captcha_text_color);
        $text_color = imagecolorallocate($image, $arr_text_color['red'],
            $arr_text_color['green'], $arr_text_color['blue']);

        $arr_noice_color = $this->hexrgb($captcha_noice_color);
        imagecolorallocate($image, $arr_noice_color['red'],
            $arr_noice_color['green'], $arr_noice_color['blue']);

        /* create a text box and add 6 letters code in it */
        $textbox = imagettfbbox($font_size, 0, $font, $code);
        $x = ($image_width - $textbox[4])/2;
        $y = ($image_height - $textbox[5])/2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);

        /* Show captcha image in the page html page */
        header('Content-Type: image/jpeg');// defining the image type to be shown in browser widow
        imagejpeg($image);//showing the image
        imagedestroy($image);//destroying the image instance
        $_SESSION['6_letters_code'] = $code;
    }

    public function hexrgb ($hexstr)//pt captcha
    {
        $int = hexdec($hexstr);

        return array("red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int);
    }
}