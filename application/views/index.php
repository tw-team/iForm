<?php
    $user = $this->session->userdata('user');
    $this->load->helper('url');
?>


<div id="content" style="display: none">
    <fieldset id = "f" class = "clonable">
        <p ID = "a">
            <label for="qtitle" class="block">Question Title:</label>
            <input type="text" name="qtitle[]" id="qtitle" placeholder="Enter question title " style="width: 400px; height: 20px;" />
        </p>
        <p ID = "b">
            <label for="qhelp" class="block">Help text:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="qhelp[]" id="qhelp" placeholder="Enter help text " style="width: 400px; height: 20px;" />
        </p>
        <p ID = "c">
            <select name = "mylist[]" id="mylist" onchange="chkind(this.value,this.id)">
                <!--<option selected="selected"> </option>-->
                <option selected="selected" name="one" value="checkbox">Multiple choice</option>
                <option name="two" value="radio"> Radio box</option>
                <option name="three" value="text">Text Area</option>
            </select>
        </p>
        <p ID = "d">
            Select your text field type:
            <select name = "type[]" id="type" onchange="chvalid(this.value,this.id)">
                <option name="four" value="text" selected="selected">Text</option>
                <option name="one" value="email">Email</option>
                <option name="two" value="number"> Number</option>
                <option name="three" value="url">URL</option>
                <option name="five" value="regex">Regex</option>
            </select>
        </p>
        <p ID = "e">
            Enter regex:
            <input type = "text" name = "regex[]" id = "regex">
        </p>

        <div ID = "button">
            <p ID = "addbut" ondrop="drop(event)" ondragover="allowDrop(event)" >
                <button class="btn btn-info" type="button" id = "addbutton" onclick="addAnswer(this.parentNode.parentNode.id)">Add field</button>
				<!--	<input type = "text" name = "answer[]" id = "ans">
					<button type="button" id = "deletebutton" onclick="deleteAnswer(this.id)">-</button> -->
			</p>
		</div>
		
		<input class ="btn btn-danger" type="button" value="Delete question" onclick="deleteQuestion(this.parentNode.parentNode.id)" /><br/><br/>
    </fieldset>
</div>


<form id="jform" action="<?php echo base_url(); ?>assets/xmlFiles/html2html.php" method="post" style="height: 100%;padding-left: 40px"  enctype="multipart/form-data">
    <input type="hidden" name="username" id="username" value=<?php echo $user['Name'] ?>>
    <input type="text" style="width: 400px" name="formtitle" id="formtitle" placeholder="Type here your form title"/><br>
	<input type="text" name="formdesc" id = "formdesc" placeholder="Your form description"/><br>

    <span id="writeroot"></span>

	<input class="btn btn-warning" type="button" onclick="moreFields()" value="Add new question" />
	<input class="btn btn-success" type="submit" value="Send form" />
</form>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="../assets/js/validate.js" charset="utf-8"></script> 

