<div class="container">
	<div style="background-color: #666666;margin: 10px; border-radius: 9px">
		<input name="form_title" style="width: 400px;margin-left: 20px;margin-top: 10px" type="text" placeholder="Form title"><br>
		<input name="form_desc" style="width: 400px;margin-left: 20px" type="text" placeholder="Form description"><br>
	</div>

	<div id="questions"></div>

    <input type="button" class="btn btn-info" style="margin-left: 30px" value="Add new question" onclick='questions_add()'>
	<input type="button" class="btn btn-success" value="Preview" onclick='preview()'>
    <input type="button" class="btn btn-success" value="Send form" onclick='send()'>
</div>