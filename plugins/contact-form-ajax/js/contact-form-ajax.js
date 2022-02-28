


function submit_contact_form()
{
    var contactFormData = new FormData();
    
    //$(selector).append(content,function(index,html))
    //1st arg of append is field name, 2nd arg is field value
	contactFormData.append('contactFormSubmit','1');
	contactFormData.append('name',$("#your_name").val());
	contactFormData.append('email',$("#your_email").val());
	contactFormData.append('phone',$("#phone_number").val());
	contactFormData.append('comments',$("#your_comments").val());
	js_submit(contactFormData,submit_contact_form_callback);


}

/**
 *  Callback function
 */

function submit_contact_form_callback(data)
{
	var jsonData = JSON.parse(data);

	if(jsonData.success == 1)
	{
        //form success message
        var message = jsonData.message;

        
		$("#response_div").html(message);
		$("#response_div").css("background-color","green");
		$("#response_div").css("color","#FFFFFF");
		$("#response_div").css("padding","20px");
	}

}

/**
 * 
 */

function js_submit(contactFormData,callback)
{
	var submitUrl = 'http://sitewpdevdev2live.local/wp-content/plugins/contact-form-ajax/process/';

	$.ajax({url: submitUrl, type:'post', data:contactFormData,contentType:false,processData:false, success:function(response){ callback(response); },});

}
