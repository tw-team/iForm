toastr.options = {
    "closeButton": false,
    "debug": false,
    "positionClass": "toast-bottom-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
function questions_add()
{
    var qhead,qtype,aopt,ainput,q;

	qhead = $('<div></div>')
		.append
		(
			$('<input>')
                .attr('type','text')
                .css('margin','10px')
                .css('width','300px')
			    .attr('name','question_text')
			    .attr('placeholder','Question')
		)
        .append
        (
            $('<input>')
                .attr('class','btn btn-danger')
                .css('margin','10px')
                .attr('type','button')
                .attr('value','Remove question')
                .attr('onclick','question_remove(this)')
        )
        .append($('<br>'))
		.append
		(
			$('<input>')
                .attr('type','text')
                .css('width','300px')
                .css('margin','10px')
                .css('margin-top','-5px')
			    .attr('name','question_help')
			    .attr('placeholder','Help text')
		)
        .append($('<br>'));


	qtype = $('<select></select>')
        .attr('class','selectpicker')
        .css('margin','10px')
        .attr('name','question_type')
		.attr('onchange','question_type_change(this)')
		.append($('<option>Single Choice</option>'))
		.append($('<option>Multiple Choice</option>'))
		.append($('<option>Input</option>'));

	aopt = $('<div></div>')
		.attr('name','answer_options')
		.append
		(
			$('<input>')
                .attr('class','btn btn-info')
                .css('margin','10px')
				.attr('type','button')
				.attr('value','Add answer option')
				.attr('onclick','answer_option_add(this)')
		)	
	
	ainput = $('<div></div>')
		.attr('name','answer_input')
		.css('display','none')	
		.append
		(
			$('<select></select>')
                .attr('class','selectpicker')
                .attr('name','answer_input_type')
                .css('margin','10px')
                .attr('onchange','answer_input_change(this)')
                .append($('<option>Text</option>'))
                .append($('<option>Number</option>'))
                .append($('<option>Email</option>'))
                .append($('<option>URL</option>'))
                .append($('<option>Regex</option>'))
		)
		.append
		(
			$('<input>')
			.attr('name','answer_input_regex')
			.css('display','none')
		);
	
	q = $('<div></div>')
        .attr('name','question')
        .css('background-color','#555555')
        .css('padding','10px')
        .css('margin','10px')
        .css('border-radius','9px')
		.append(qhead)
		.append(qtype)
		.append(aopt)
        .append(ainput);
	$('#questions').append(q);	
}

function question_remove(el)
{
	$(el).parent().parent().remove();			
}

function question_type_change(el)
{
	
	$(el).parent().find('[name="answer_options"]').first().hide();
	$(el).parent().find('[name="answer_input"]').first().hide();
	if($(el).val() != 'Input')
		$(el).parent().find('[name="answer_options"]').first().show();
	else
		$(el).parent().find('[name="answer_input"]').first().show();	

}

function answer_option_add(el)
{
    var opt;
	opt = $('<div></div>')
        .attr('name','answer_option')
		.append
        (
            $('<input>')
                .attr('name','answer_option_text')
                .attr('type','text')
                .css('margin','5px')
                .css('margin-left','15px')
                .attr('placeholder','Enter option')
        )
		.append
		(
			$('<input>')
                .attr('class','btn btn-danger')
                .css('margin','5px')
                .attr('type','button')
                .attr('value','Remove option')
                .attr('onclick','answer_option_remove(this)')
		);
	$(el).parent().append(opt);
}

function answer_option_remove(el)
{
	$(el).parent().remove();
}

function answer_input_change(el)
{
	if($(el).val() == 'Regex')
		$(el).parent().find('[name=answer_input_regex]').first().show();
	else
		$(el).parent().find('[name=answer_input_regex]').first().hide();
	
}

function validate_form()
{
    $('.invalid').each(validate_reset);
    window.is_valid = 0;
    validate_input($('[name=form_title]').first());
    $('[name=question]').each(validate_question);
    if(window.is_valid == 2)
    {
        toastr.error("Validation error. Please fill marked fields");
        return;
    }
    if($('[name=question]').length == 0)
    {
        toastr.error("Form is empty. Please add a question!");
        return;
    }
    return !window.is_valid;
}

function validate_question(idx,el)
{
    var opt,text,cnt;
    validate_input($(el).find('[name=question_text]').first());
    if(window.is_valid)
        return;
    text = $(el).find('[name=question_text]').first().val();
    opt = $(el).find('select').first().val();
    cnt = $(el).find('[name=answer_option]').length;
    switch (opt)
    {
        case "Single Choice":
            if(cnt < 2)
            {
                toastr.error("Question \""+text+"\" must have at least two options");
                window.is_valid = 1;
            }
            $(el).find('[name=answer_option_text]').each(function(idx,item){validate_input(item)});
            break;
        case "Multiple Choice":
            if(cnt < 1)
            {
                toastr.error("Question \""+text+"\" must have at least one option");
                window.is_valid = 1;
            }
            $(el).find('[name=answer_option_text]').each(function(idx,item){validate_input(item)});
            break;
        case "Input":
            if($(el).find('[name=answer_input_type]').first().val()=="Regex")
                validate_input($(el).find('[name=answer_input_regex]').first())
            break;
    }
}

function validate_reset(idx,input)
{
    $(input).css('border','');
    $(input).removeClass('invalid');
}

function validate_input(input)
{
    var text;
	text = $(input).val();
	if(text.length)
		return text;
	$(input).css('border','1px solid red');
    $(input).addClass('invalid');
    window.is_valid = 2;
}

function create_form_json()
{
    var json = new Object();
    window.questions = new Array();

    json['form_title'] = $('[name=form_title]').first().val();
    json['form_desc'] = $('[name=form_desc]').first().val();

    $('[name=question]').each( function(idx,item)
    {
        create_question_json(item);
        window.questions.push(window.question);
    });
    json['questions'] = window.questions;
    return JSON.stringify(json);
}

function create_question_json(item)
{
    window.question = new Object();
    window.question['question_text'] = $(item).find('[name=question_text]').first().val();
    window.question['question_help'] = $(item).find('[name=question_help]').first().val();
    window.question['question_type'] = $(item).find('[name=question_type]').first().val();
    switch (window.question['question_type'])
    {
        case 'Single Choice':
        case 'Multiple Choice':
            window.options = new Array();
            $(item).find('[name=answer_option_text]').each(function (idx,item)
            {
                window.options.push($(item).val());
            })
            window.question['options']=window.options;
            break;
        case 'Input':
            window.question['answer_input_type'] = $(item).find('[name=answer_input_type]').first().val();
            if(window.question['answer_input_type'] == 'Regex')
                window.question['answer_regex'] = $(item).find('[name=answer_input_regex]').first().val();
            break;
    }
}

function preview()
{
    var data;
    if(validate_form())
    {
        data=create_form_json();
        $.post("preview",{'form':data}).done(function(data)
        {
            var win = window.open("","Preview","fullscreen=1");
            win.document.write(data);
        })
    }
}

function populate_form()
{
    var head,json,question;
    json = window.form;
    head = $("<div></div>")
        .css("margin","10px")
        .append
        (
            $("<h1></h1>")
                .text(json["form_title"])
        )
        .append
        (
            $("<h3></h3>")
                .text(json["form_desc"])
        );
    $("#content")
        .append(head);
    for(question in json["questions"])
        $("#content").append(populate_question(question,json["questions"][question]))
}

function populate_question(idx,json)
{
    var head,question;

    head = $("<div></div>")
        .append
        (
            $("<h3></h3>")
                .text(json["question_text"])
        )
        .append
        (
            $("<h4></h4>")
                .text(json["question_help"])
        );
    question = $("<div></div>")
        .css("padding","20px")
        .css("margin","10px")
        .css("background-color","#555555")
        .css("border-radius","9px")
        .attr("id","question_"+idx.toString())
        .append(head);
    switch(json["question_type"])
    {
        case("Input"):
            switch(json["answer_input_type"])
            {
                case "Text":
                case "Regex":
                    $(question)
                        .append
                        (
                            $("<input>")
                        .attr("type","text")
                        );
                    break;
                case "Number" :
                    $(question)
                        .append
                        (
                            $("<input>")
                                .attr("type","number")
                        );
                    break;
                case "URL":
                    $(question)
                        .append
                        (
                            $("<input>")
                                .attr("type","Url")
                        );
                    break;
                case "Email":
                    $(question)
                        .append
                        (
                            $("<input>")
                                .attr("type","email")
                        );

            }
            break;
        case("Multiple Choice"):
            var i,val;
            for(i in json["options"])
            {
                val = json["options"][i];
                $(question)
                    .append
                    (
                        $("<input>")
                            .attr("type","checkbox")
                            .attr("txt",val)
                            .css("margin-right","5px")
                    )
                    .append(val)
                    .append("<br>");
            }
            break;
        case("Single Choice"):
            var i,val;
            for(i in json["options"])
            {
                val = json["options"][i];
                $(question)
                    .append
                    (
                        $("<input>")
                            .attr("type","radio")
                            .attr("txt",val)
                            .attr("name","grp"+idx)
                            .css("margin-right","5px")
                    )
                    .append(val)
                    .append("<br>");
            }
            break;
    }
    return question;
}

function send()
{
    var data,title;
    title = $('[name=form_title]').first().val();
    if(validate_form())
    {
        data=create_form_json();
        $.post("store",{'form':data,'title':title}).done(function(data)
        {
            window.location.href = "../";
        }).fail(function(data)
            {
                document.write(data);
            })
    }
}

function answer_validate()
{
    var json,idx;
    var answers = new Array();
    json = window.form;
    for(idx in json["questions"])
    {
        var question = json["questions"][idx];
        var root = $("#question_"+idx.toString());
        switch(question["question_type"])
        {
            case "Single Choice":
                if($(root).find('input:checked').length <1)
                {
                    toastr.error("No answer for question \""+question["question_text"]+"\"");
                    return false;
                }
                answers.push($(root).find('input:checked').first().attr('txt'))
                break
            case "Multiple Choice":
                window.opts = new Array();
                $(root).find('input:checked').each(
                    function(idx,el)
                    {
                        window.opts.push($(el).attr('txt'))
                    }
                )
                answers.push(window.opts);
                break;
            case "Input":
                var val = $(root).find('input').first().val();
                switch(question["answer_input_type"])
                {
                    case 'Text':
                        if(val == '')
                        {
                            toastr.error("No answer for question \""+question["question_text"]+"\"");
                            return false;
                        }
                        answers.push(val)
                        break;
                    case 'Number':
                        if(! val.match(/^[1-9][0-9]*$/))
                        {
                            toastr.error("Answer for question \""+question["question_text"]+"\" must be a number");
                            return false;
                        }
                        answers.push(val);
                        break
                    case 'Email':
                        if(! val.match(/^([\w\-_.]+\@[\w\-]+\.[\w\-]+)$/))
                        {
                            toastr.error("Answer for question \""+question["question_text"]+"\" must be an email address");
                            return false;
                        }
                        answers.push(val);
                        break;
                    case 'URL':
                        if(! val.match(/^\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]$/i))
                        {
                            toastr.error("Answer for question \""+question["question_text"]+"\" must be an URL address");
                            return false;
                        }
                        answers.push(val);
                        break;
                    case 'Regex':
                        if(! val.match(question["answer_regex"]))
                        {
                            toastr.error("Answer for question \""+question["question_text"]+"\" must match \""+question['answer_regex']+"\"");
                            return false;
                        }
                        answers.push(val);
                        break;
                }
        }
    }
    return answers;
}

function answer_send()
{
    var answers;
    if(answers = answer_validate())
    {

        data=JSON.stringify(answers);

        $.post("save_answers",{'answers':data,'token':$('#token').val()}).done(function(data)
        {
            if(data == '')
                window.location.href = "../";
            else
                document.write(data);
        }).fail(function(data)
            {
                document.write(data);
            })
    }
}

function show_results(el)
{
    $token = $(el).parent().find('[name=token]').first().val();
    $.post("form_page/show_results",{'token':$token}).done(function(data)
    {
        //alert(data);
        var json = JSON.parse(data);
        table = create_table(json);
        $("#result_table").remove();
        $(el).parent().append(table);
    }).fail(function(data)
        {
            document.write(JSON.stringify(data));
        })
}

function create_table(data)
{
    var table,row;
    table = $('<table></table>')
        .css('border','1px solid')
        .attr('border','1')
        .attr('id','result_table')
    //create header
    questions = data['head']["questions"];
    results = data['result'];
    row = $('<tr></tr>');
    for(i in questions)
    {
        $(row).append(
            $('<th class="table_header"></th class>')
                .text(questions[i]['question_text'])
        )
    }
    $(table).append(row);
    for(i in results)
    {
        row = $('<tr></tr>');
        for(j in results[i])
        {
            val = results[i][j];
            if(typeof val === "[object Array]")
            {
                val = val.join();
            }
            if(val == '')
                val = 'N\\A';
            $(row).append(
                $('<td></td>')
                    .text(val)
            )
        }
        table.append(row);
    }
    return table;
}

function delete_form(el)
{   window.el = el;
    $token = $(el).parent().find('[name=token]').first().val();
    $.post("form_page/delete",{'token':$token}).done(function(data)
    {
        if(data == '')
        {
            $(window.el).parent().remove();
        }
        else
        {
            toastr.error("Server error. Please try again."+data);
        }
    }).fail(function(data)
        {
            document.write(JSON.stringify(data));
        })
}
