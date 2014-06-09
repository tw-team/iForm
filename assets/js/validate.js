var counter = 0;
var myids = new Array(100);
var myans = new Array(1000);


function moreFields()
{
    counter = $("fieldset").size() - 1;
    //alert(counter);
    var position = counter + 1;
    if (position < 20)
    {
	    for(var i = 1; i <= counter; i++)
		    if(myids[i] === 0)
			    position = i;
	    myids[position] = 1;
	    counter++;
	    var newFields = document.getElementById('content').cloneNode(true);
	    newFields.id = 'content' + position;
	    newFields.style.display = 'block';
	    var newField = newFields.childNodes;
	    for (var i=0;i<newField.length;i++)
        {
		    var newFieldChild = newField[i].childNodes;
		    for (var j=0;j<newFieldChild.length;j++)
            {
			    var id = newFieldChild[j].id
			    newFieldChild[j].id = id + position;
			    newFieldChild1 = newFieldChild[j].childNodes;
			    for (var k=0;k<newFieldChild1.length;k++)
                {
				    var id = newFieldChild1[k].id
				    newFieldChild1[k].id = id + position;
				    newFieldChild2 = newFieldChild1[k].childNodes;
				    for (var l=0;l<newFieldChild2.length;l++)
                    {
					    var id = newFieldChild2[l].id
					    newFieldChild2[l].id = id + position;
				    }
			    }
		    }
		    var id = newField[i].id
		    newField[i].id = id + position;
	    }
	    var insertHere = document.getElementById('writeroot');
	    insertHere.parentNode.insertBefore(newFields,insertHere);
    }
    else
        alert("You have reached the maximum number of questions.");
}


function moreFieldsHidden()
{
    counter = $("fieldset").size() - 1;
    //alert(counter);
    var position = counter + 1;
	for(var i = 1; i <= counter; i++)
		if(myids[i] === 0)
			position = i;
	myids[position] = 1;

	counter++;
	var newFields = document.getElementById('content').cloneNode(true);
	newFields.id = 'content' + position;
	newFields.style.display = 'block';
	var newField = newFields.childNodes;
	for (var i=0;i<newField.length;i++)
    {
		var newFieldChild = newField[i].childNodes;
		for (var j=0;j<newFieldChild.length;j++)
        {
			var id = newFieldChild[j].id
			newFieldChild[j].id = id + position;
			newFieldChild1 = newFieldChild[j].childNodes;
			for (var k=0;k<newFieldChild1.length;k++)
            {
				var id = newFieldChild1[k].id
				newFieldChild1[k].id = id + position;
			
				newFieldChild2 = newFieldChild1[k].childNodes;
				for (var l=0;l<newFieldChild2.length;l++)
                {
					var id = newFieldChild2[l].id
					newFieldChild2[l].id = id + position;
				}
			}
		}
		
		var id = newField[i].id
		newField[i].id = id + position;
	}
}


//var answers = $("div").size() - $("fieldset").size();// - 1  $(".answer").size() + 1;
function addAnswer(id)
{
    answers = $('.answer').size();
    var position = answers + 1;
	for(var i = 1; i <= answers; i++)
		if(myans[i] === 0)
			position = i;
	myans[position] = 1;

    //alert(answers);
	answers++;
	var lastChar ;//= id.substr(id.length - 1);
	var nr = id.substr(id.length - 1);
	var cifra = id.substr(id.length - 2);
	if(cifra < 100 && cifra > 9)
    {
		lastChar = cifra;
	}
	else
		lastChar = nr;
    //	alert('adauga la idul ' +id);
	write = document.getElementById('button' + lastChar);
    write.innerHTML += '<p ID = "sbut' + position + '" class ="answer"><input type = "text" name = "answer' + lastChar +'[]" id = "answer' + position+ '"><button type="button" id = "deletebutton' + position+ '" onclick="deleteAnswer(this.parentNode.id)">-</button></p>';
	 //<br />';
}


function deleteAnswer(id)
{
	var lastChar ;//= id.substr(id.length - 1);
	var nr = id.substr(id.length - 1);
	var cifra = id.substr(id.length - 2);
	if(cifra < 100 && cifra > 9)
    {
		lastChar = cifra;
	}
	else
		lastChar = nr;
		
	$('#'+id).remove();	
	myans[lastChar] = 0;
}


function deleteQuestion(id)
{
	var lastChar ;//= id.substr(id.length - 1);
	var nr = id.substr(id.length - 1);
	var cifra = id.substr(id.length - 2);
	if(cifra < 100 && cifra > 9)
    {
		lastChar = cifra;
	}
	else
		lastChar = nr;
	$('#'+id).remove();
	myids[lastChar] = 0;
}

function chkind(selectedText,id)
{
    //	alert (selectedText);
	var lastChar ;//= id.substr(id.length - 1);
	var nr = id.substr(id.length - 1);
	var cifra = id.substr(id.length - 2);
	if(cifra < 100 && cifra > 9)
    {
		lastChar = cifra;
	}
	else
		lastChar = nr;
	switch (selectedText)
    {
		case "checkbox":
            $('#d'+lastChar).hide();
            $('#button'+lastChar).show();
            $('#e'+lastChar).hide();
            break;
		case "radio":
            $('#d'+lastChar ).hide();
            $('#button'+lastChar).show();
            $('#e'+lastChar).hide();
            break;
		case "text" :
            $('#d'+lastChar ).show();
            $('#button'+lastChar).hide();
            $('#e' + lastChar).hide();
            break;
	}
}

function chvalid(selectedText,id)
{
    //	alert (selectedText);
	var lastChar ;//= id.substr(id.length - 1);
	var nr = id.substr(id.length - 1);
	var cifra = id.substr(id.length - 2);
	if(cifra < 100 && cifra > 9)
    {
		lastChar = cifra;
	}
	else
		lastChar = nr;
	switch (selectedText)
    {
		case "regex":
            $('#e'+lastChar).show();
            break;
		default :
            $('#e'+lastChar ).hide();
            break;
	}
}

/*
var value = "Untitled",description = "Form description",state = 1;
function displayInput1(id){
	$('#t1').html('<input type="text" name = "qtitle" id="Ftitle1" style="width: 250px; height: 20px;"/>');
	$('#Ftitle1').val(value);
}
function click1(id){
	state = 0;
}
function displayNormal(id){
	if(state % 2 == 0){
			value = $('input[id=Ftitle1]').val();
			if(value == "")
				$("#t1").html("null title plese enter a title for this form");
			else
				$("#t1").html(value);
	}
}

function displayInput2(id){
	$('#t2').html('<input type="text" name = "qtitle" id="Ftitle2" style="width: 250px; height: 20px;"/>');
	$('#Ftitle2').val(description);
}

/*
$(document).click(function() { 
		// Check for left button
		state ++;
		alert(state);
		}
});*/

function drag(ev)
{
	ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
	ev.preventDefault();
	var data=ev.dataTransfer.getData("Text");
	ev.target.appendChild(document.getElementById(data));
}

$(document).ready(function()
{
    var state = 0,state1 = 0;
    var value = $("#formtitle").val();
    var description = $("#formdesc").val();

    $('#d').hide();
    $('#e').hide();
    $("#formdesc").val(description);
    $('#formtitle').val(value);

    $(document).click(function()
    {
        state = 0; state1 = 0;
	    if(typeof $('input[id=Ftitle1]').val() != 'undefined' && $('input[id=Ftitle1]').val() != "")
        {
		    value = $('input[id=Ftitle1]').val();
		    $("#t1").html(value);
		    $('#formtitle').val(value);
	    }
	    if(typeof $('input[id=Ftitle2]').val() != 'undefined' && $('input[id=Ftitle2]').val() != "")
        {
		    description = $('input[id=Ftitle2]').val();
		    $("#t2").html(description);
		    $("#formdesc").val(description);
	    }
    });

	$("#title").hover(function ()
    {
		if(state == 0)
        {
			$("#t1").html('<input type="text" name = "qtitle" id="Ftitle1" style="width: 250px; height: 20px;"/>');
			$('#Ftitle1').val(value);
			$('#formtitle').val(value);			
		}
	},function ()
    {
	    if(state == 0)
        {
			value = $('input[id=Ftitle1]').val();
			if(value == "")
				$("#t1").html("null title plese enter a title for this form");
			else
            {
				$("#t1").html(value);
				$('#formtitle').val(value);
			}				
		}
	});
	
	$("#title1").hover(function ()
    {
		if(state1 == 0)
        {
			$("#t2").html('<input type="text" name = "qtitle" id="Ftitle2" style="width: 250px; height: 20px;"/>');
			$('#Ftitle2').val(description);
			$("#formdesc").val(description);
		}
    },function ()
    {
		if(state1 == 0)
        {
			description = $('input[id=Ftitle2]').val();
			if(description == "")
				$("#t2").html("null title plese enter a title for this form");
			else
            {
				$("#t2").html(description);
				$("#formdesc").val(description);
			}
		}
	});
	
	$('#title').click(function(event)
    {
		state = 1;
		state1 = 0;
		if(typeof $('input[id=Ftitle2]').val() != 'undefined' && $('input[id=Ftitle2]').val() != "")
        {
			description = $('input[id=Ftitle2]').val();
			$("#formdesc").val(description);
			$("#t2").html(description);
		}
		event.stopPropagation();	
    });

    $('#title1').click(function(event)
    {
		state = 0;
		state1 = 1;
		if(typeof $('input[id=Ftitle1]').val() != 'undefined' && $('input[id=Ftitle1]').val() != "")
        {
			value = $('input[id=Ftitle1]').val();
			$('#formtitle').val(value);	
			$("#t1").html(value);
		}
		event.stopPropagation();
    });
	
});

//window.onload = addAnswer;