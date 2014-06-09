<?php
    $user = $this->session->userdata('user');
?>
<div class="container-fluid" style="margin-top: 10px">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="<?php echo base_url("home");?>">iForm</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                     <!--   <li><a href="<?php echo base_url("home");?>">Home</a></li> -->
                        <?php
                        if($user)
                            echo '<li><a href="'.base_url("form_page/create").'">Create new form</a></li>';
                        ?>
                         <li><a href="<?php echo base_url("form_page/about");?>">About</a></li>
                    </ul>

                
                    <ul class="nav pull-right">
                        <li class="hidden-phone hidden-tablet"><a class="brand" href="#">Hello <?php
                                if($user)
                                    echo $user['Name'];
                                else
                                    echo 'Guest';
                                ?>!</a></li>
                        <?php
                        if($user)
                            echo '<li><a href="'.base_url("user/change_password").'">Change password</a></li>';
                        ?>
                        <?php
                        if($user)
                            echo '<li><a href="'.base_url("user/logout").'">Logout</a></li>';
                        else
                            echo '<li><a href="'.base_url("user/register").'">Register</a></li>';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function hide_message()
{
    document.getElementById('message').style.display = 'none';
}
</script>

<?php
if(isset($this->session->userdata['message']))
{?>
<div class="container">
<div class="container span4 offset4 text-center" style="background: #999999;margin-bottom: 10px;border-radius:4px" id="message">
    <button type="button" class="close" onclick="hide_message()">&times;</button>
    <?php echo $this->session->userdata['message']; ?>
</div></div>
<?php
    echo $this->session->unset_userdata('message');
}?>
