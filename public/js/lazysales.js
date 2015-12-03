//Lazysale - nguyenphuongthai94@gmail.com





function language(lang)
{
	$.post
	(
		'http://localhost/lazysales/public/lang', {lang:lang}, 
		function(result)
		{	
			
			
			location.reload();
		}
	);
	
}


function show_post()
{
	album=false;
	document.getElementById("album").style.display="none";
	document.getElementById("post").style.display="block";
	document.getElementById("btn_album").style.display="none";
	if(current_node=="group")
		loadgroups();
	else
		loadpages();
	
}

function show_album()
{
	document.getElementById("post").style.display="none";
	document.getElementById("album").style.display="block";
	document.getElementById("btn_album").style.display="block";
	album=true;
	if(current_node=="group")
		loadgroups();
	else
		loadpages();
}

// No submit form
function nosubmit()
{
	return false;
}
function gettimezone()
{
	var offset = new Date().getTimezoneOffset();
	var minutes = Math.abs(offset);
	var hours = Math.floor(minutes / 60);
	var prefix = offset <= 0 ? "+" : "-";
	var timezone = prefix+hours;
	return timezone;
}


function loadhistory()
{	
	
	var timezone = gettimezone();
	
	$("#log_history").empty();
	document.getElementById("loading_history").style.display="block";
	$.post
	(
		'http://localhost/lazysales/public/history',{timezone:timezone}, 
		function(result)
		{	
			document.getElementById("loading_history").style.display="none";
			$("#log_history").html(result);
		}
	);
}

function loadpages()
{	
	current_node="page";
	$("#list").empty();
	document.getElementById("loading_node").style.display="block";
	document.getElementById("btn_group").style.display="none";
	if(album==true)
	{
		document.getElementById("btn_album").style.display="block";
		document.getElementById("btn_page").style.display="none";
	}
	else
	{
		document.getElementById("btn_album").style.display="none";
		document.getElementById("btn_page").style.display="block";
	}
	
	
	$.get
	(
		'http://localhost/lazysales/public/data/page', 
		function(result)
		{	
			document.getElementById("loading_node").style.display="none";
			$("#list").html(result);
		}
	);
}
function loadgroups()
{	
	current_node="group";
	$("#list").empty();
	document.getElementById("loading_node").style.display="block";
	
	document.getElementById("btn_page").style.display="none";
	if(album==true)
	{
		document.getElementById("btn_album").style.display="block";
		document.getElementById("btn_group").style.display="none";
	}
	else
	{
		document.getElementById("btn_album").style.display="none";
		document.getElementById("btn_group").style.display="block";
	}
		
	
	$.get
	(
		'http://localhost/lazysales/public/data/group',
		function(result)
		{	
			document.getElementById("loading_node").style.display="none";
			$("#list").html(result);
		}
	);
}
function clear()
{
	$("#log").html("");
	$("#log2").html("");
	$("#process").html("");
}

function upload_album(form)
{
	document.getElementById("list_images").style.display="none";
	var images= document.getElementById("images").value;
	if(images!="")
	{
	
	document.getElementById("loading_album").style.display="block";
	$.ajax({
		url: "http://localhost/lazysales/public/upload_album", // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			document.getElementById("loading_album").style.display="none";
			document.getElementById("list_images").style.display="block";
			$("#images_preview").html(data);
			
		}
		});
	}
	else
	{
		document.getElementById("list_images").style.display="none";
		$("#images_preview").empty();
	}
	
}
function upload(form)
{	
	document.getElementById("loaded_image").style.display="none";
	var image= document.getElementById("image").value;
	if(image!="")
	{
	
	document.getElementById("loading_image").style.display="block";
	$.ajax({
		url: "http://localhost/lazysales/public/upload_image", // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			document.getElementById("loading_image").style.display="none";
			document.getElementById("loaded_image").style.display="block";
			$('#loaded_image').html(data);
			
		}
		});
	}
}
function show_schedule()
{	clear();
	document.getElementById("datetimepicker").style.display="block";
}
function check_datetime()
{
	var date= document.getElementById("date").value;
	var time= document.getElementById("time").value;

	if(date==""||time=="")
	{
		$("#log").empty();
		$("#log").html('You have not set schedule-time');
		return false;
		
	}
	else
	{
		//firefox k nhan dc date
		var date = new Date(document.getElementById("date").value+" "+document.getElementById("time").value);
		var date_now = new Date();
		
		
		if(date > date_now)
		{
			var diff = Math.abs(date-date_now);
			var count_min=Math.round(diff/60000);
		
			if(count_min>=10 && count_min <= 229200)
			{
				return true;
				
			}
			else
			{
				$("#log").empty();
				$("#log").html('The schedule-time incorrect: Too far');
				return false;
				
			}
		}
		else
		{
			
				$("#log").empty();
				$("#log").html('The schedule-time incorrect: too passed');
				return false;
			
		}
	}
		
}
function schedule_page()
{
	clear();
	
	if(checkinput()==true && check_datetime()==true)
	{
		
		$("#process").html('Processing...');
		var timezone=gettimezone();
		var datetime = document.getElementById("date").value+' '+document.getElementById("time").value;
		var image= document.getElementById("image").value;
		var message= document.getElementById("message").value;
		var link= document.getElementById("link").value;
		var inputElems = document.getElementsByTagName("input");
		var node_list =[];
		var access_token_list =[];
		count=0;
		posted=0;
		for (var i=0; i<inputElems.length; i++) 
		{
		   if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].value != "checkall") 
		   {
				count++;
				node_list.push(inputElems[i].value);
				access_token_list.push( document.getElementById(inputElems[i].value).name);
				
				$.post("http://localhost/lazysales/public/post/schedule", 
					{
						image: image,
						message: message,
						link: link, 
						node: inputElems[i].value, 
						access_token: document.getElementById(inputElems[i].value).name,
						timezone: timezone,
						schedule: datetime
					}, 
					function(result)
					{	 
						posted++;
						$("#process").html('Success: '+posted+ "/"+count+' pages');
						var temp=Math.round((posted/count)*100);
						document.getElementById("processbar1").style.display="block";
						document.getElementById("processbar2").style.display="block";
						document.getElementById("processbar2").style.width=temp+'%';
						if(temp==100)
						{
						document.getElementById("processbar1").style.display="none";
							document.getElementById("processbar2").style.display="none";
						}  
						$("#log").html(result);
					}
				);
		   }

		}
		var section="page";
		$.post("http://localhost/lazysales/public/save",
			{
				image: image,
				message: message,
				link: link,
				node_list: node_list, 
				section: section,
				timezone: timezone,
				schedule: datetime
			}, 
			function(result)
			{  
				$("#log2").html(result);
			}
		);
		
		
			
		
	}
}
function post_album_group()
{	
	clear();
	document.getElementById("datetimepicker").style.display="none";
	var images=document.getElementById("images").value;
	if(check_album_input()==true)
	{	
		$("#process").html('<?php echo $processing; ?>');
		var album_tittle= document.getElementById("album_tittle").value;
		var album_decription= document.getElementById("album_decription").value;
		var inputElems = document.getElementsByTagName("input");
		var node_list =[];
		var list_decrip=[];
		
		for (var i=0; i<list_images.length; i++)
		{
			list_decrip.push(document.getElementById(list_images[i]).value);
		}
		
		count=0;
		posted=0;
		for (var i=0; i<inputElems.length; i++) 
		{
		   if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].value != "checkall") 
		   {
				count++;
				node_list.push(inputElems[i].value);
				$.post("http://localhost/lazysales/public/process_album", 
					{
						album_tittle: album_tittle,
						album_decription: album_decription,
						list_decrip: list_decrip, 
						list_images: list_images,
						node: inputElems[i].value, 
					}, 
					function(result)
					{	 
						
						posted++;
						$("#process").html('<?php echo $posted; ?> '+posted+ "/"+count+' <?php echo $page; ?>');
						var temp=Math.round((posted/count)*100);
						document.getElementById("processbar1").style.display="block";
						document.getElementById("processbar2").style.display="block";
						document.getElementById("processbar2").style.width=temp+'%';
						if(temp==100)
						{
							document.getElementById("processbar1").style.display="none";
							document.getElementById("processbar2").style.display="none";
						}  
						$("#log").html(result);
					}
				);
						
			
		   }

		}
		var section="group";
		$.post("http://localhost/lazysales/public/process_album",
			{
				image:"",
				message:"",
				link:"",
				album:'album',
				node_list: node_list, 
				section: section
			}, 
			function(result)
			{  
				$("#log2").html(result);
			}
		);

	}
	else
	{
		$("#log").empty();
		$("#log").html('<?php echo $you_have_not_entered_enough; ?>');
	}
}
function post_album()
{
	if(current_node=="page")
		post_album_page();
	else
		post_album_group();
}
function check_album_input()
{
	var album_tittle=document.getElementById("album_tittle").value;
	if(album_tittle!="" && countcheckbox()!=0)
		return true;
	else
		return false;
}	
function post_album_page()
{	
	clear();
	document.getElementById("datetimepicker").style.display="none";
	var images=document.getElementById("images").value;
	if(check_album_input()==true)
	{	
		$("#process").html('<?php echo $processing; ?>');
		var album_tittle= document.getElementById("album_tittle").value;
		var album_decription= document.getElementById("album_decription").value;
		var inputElems = document.getElementsByTagName("input");
		var node_list =[];
		var access_token_list =[];
		var list_decrip=[];
		
		for (var i=0; i<list_images.length; i++)
		{
			list_decrip.push(document.getElementById(list_images[i]).value);
		}
		
		count=0;
		posted=0;
		for (var i=0; i<inputElems.length; i++) 
		{
		   if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].value != "checkall") 
		   {
				count++;
				node_list.push(inputElems[i].value);
				access_token_list.push( document.getElementById(inputElems[i].value).name);
				$.post("http://localhost/lazysales/public/process_album", 
					{
						album_tittle: album_tittle,
						album_decription: album_decription,
						list_decrip: list_decrip, 
						list_images: list_images,
						node: inputElems[i].value, 
						access_token: document.getElementById(inputElems[i].value).name
					}, 
					function(result)
					{	 
						
						posted++;
						$("#process").html('<?php echo $posted; ?> '+posted+ "/"+count+' <?php echo $page; ?>');
						var temp=Math.round((posted/count)*100);
						document.getElementById("processbar1").style.display="block";
						document.getElementById("processbar2").style.display="block";
						document.getElementById("processbar2").style.width=temp+'%';
						if(temp==100)
						{
							document.getElementById("processbar1").style.display="none";
							document.getElementById("processbar2").style.display="none";
						}  
						$("#log").html(result);
					}
				);
						
			
		   }

		}
		var section="page";
		$.post("http://localhost/lazysales/public/process_album",
			{
				image:"",
				message:"",
				link:"",
				album:'album',
				node_list: node_list, 
				section: section
			}, 
			function(result)
			{  
				$("#log2").html(result);
			}
		);

	}
	else
	{
		$("#log").empty();
		$("#log").html('<?php echo $you_have_not_entered_enough; ?>');
	}
}
function post_page()
{	
	clear();
	document.getElementById("datetimepicker").style.display="none";
	if(checkinput()==true)
	{
		
		
		$("#process").html('Processing');
		var image= document.getElementById("image").value;
		var message= document.getElementById("message").value;
		var link= document.getElementById("link").value;
		var inputElems = document.getElementsByTagName("input");
		var node_list =[];
		var access_token_list =[];
		count=0;
		posted=0;
		for (var i=0; i<inputElems.length; i++) 
		{
		   if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].value != "checkall") 
		   {
				count++;
				node_list.push(inputElems[i].value);
				access_token_list.push( document.getElementById(inputElems[i].value).name);
				
				$.post("http://localhost/lazysales/public/post/now", 
					{
						image: image,
						message: message,
						link: link, 
						node: inputElems[i].value, 
						access_token: document.getElementById(inputElems[i].value).name
					}, 
					function(result)
					{	 
						posted++;
						$("#process").html('Success '+posted+ "/"+count+' page');
						var temp=Math.round((posted/count)*100);
						document.getElementById("processbar1").style.display="block";
						document.getElementById("processbar2").style.display="block";
						document.getElementById("processbar2").style.width=temp+'%';
						if(temp==100)
						{
							document.getElementById("processbar1").style.display="none";
							document.getElementById("processbar2").style.display="none";
						}  
						$("#log").html(result);
					}
				);
		   }

		}
		var section="page";
		$.post("http://localhost/lazysales/public/save",
			{
				image: image,
				message: message,
				link: link,
				node_list: node_list, 
				section: section
			}, 
			function(result)
			{  
				$("#log2").html(result);
			}
		);
		
		
			
		
	}
}
function post_group()
{	
	clear();
	
	document.getElementById("datetimepicker").style.display="none";
	if(checkinput()==true)
	{
		
		
		$("#process").html('Processing');
		var image= document.getElementById("image").value;
		var message= document.getElementById("message").value;
		var link= document.getElementById("link").value;
		var inputElems = document.getElementsByTagName("input");
		count=0;
		posted=0;
		var node_list =[];
		
		for (var i=0; i<inputElems.length; i++) 
		{
		   if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].value != "checkall") 
		   {
				
				count++;
				node_list.push(inputElems[i].value);
				
				$.post("http://localhost/lazysales/public/post/now", 
					{
						image: image,
						message: message,
						link: link, 
						node: inputElems[i].value,
					}, 
					function(result)
					{		         		   
						posted++;
						$("#process").html('Success: '+posted+ "/"+count+' group');
						var temp=Math.round((posted/count)*100);
						document.getElementById("processbar1").style.display="block";
						document.getElementById("processbar2").style.display="block";
						document.getElementById("processbar2").style.width=temp+'%';
						if(temp==100)
						 {
							document.getElementById("processbar1").style.display="none";
							document.getElementById("processbar2").style.display="none";
						 }
					$("#log").html(result); 
					}
				);			  
		   }
				
		}
		var section="group";
		$.post("http://localhost/lazysales/public/save", 
			{
				image: image,
				message: message,
				link: link, 
				node_list: node_list, 
				section:section 
			}, 
			function(result)
			{
		  
				$("#log2").html(result);
			}
		);
		
		
			
		
	}
}	
/*
function getCookie(name) 
{
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
//recheck checkbox
function recheckbox()
{ 	
	var count=getCookie("countgroup");
	for (var i = 0; i< count; i++) 
	{
		
		var temp=getCookie("group["+i+"]");
		document.getElementById(temp).checked = true;
	}

}*/
// auto check all checkbox
$(function (){
    $("#checkall").click (function () {
        var checkedStatus = this.checked;
        $("#listcheck tbody tr").find(":checkbox").each(function () {
            $(this).prop("checked", checkedStatus);
        });
    });
});

// cout checkbox checked
function countcheckbox()
{
	var inputElems = document.getElementsByTagName("input"),
	count = 0;
	for (var i=0; i<inputElems.length; i++) 
	{
		if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) 
		{
    		count++;
		}
	}
	return count;
}
//uikit show modal
var modal = UIkit.modal(".modalSelector");
if ( modal.isActive() ) {
    modal.hide();
} else {
    modal.show();
}

//uikit show datepicker
//var datepicker = UIkit.datepicker(element, {});
//var timepicker = UIkit.timepicker(element, { /* options */ });


// Check input corect
function checkinput()
{
var link= document.getElementById("link").value;
var message= document.getElementById("message").value;
var image= document.getElementById("image").value;
if(link=="" && message=="" && image=="" || countcheckbox()==0)
{	$("#log").empty();
	$("#log").html("You have not entered enough");
	return false;
}
else
{
	if(link=="")
		{

			return true;
		}
		else
		{
			var str= document.getElementById("link").value;
	   		if(str.match(/([a-zA-Z0-9_\.\-])+(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+/gi))
			{
			
				return true;	
			}
			else
			{
				$("#log").empty();
				$("#log").html("The link is incorrect");
				return false;	
			}
		}
}
}