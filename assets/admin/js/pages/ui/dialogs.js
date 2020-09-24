$('.js-sweetalert').click(function () {
	var type = $(this).data('type');
	if (type === 'basic') {
		showBasicMessage();
	}
	else if (type === 'with-title') {
		showWithTitleMessage();
	}
	else if (type === 'success') {
		showSuccessMessage();
	}
	else if (type === 'confirm') {
		showConfirmMessage();
	}
	else if (type === 'cancel')
	{
		var datatype= $(this).data('datatype');
		var dataid	= $(this).data('dataid');
		var url		= $(this).data('url');
		var colname	= $(this).data('colname');
		if($(this).data('dataname'))
			var dataname=$(this).data('dataname');
		else
			var dataname='it';
		showCancelMessage(datatype, dataid, dataname, url, colname);
	}
	else if (type === 'with-custom-icon') {
		showWithCustomIconMessage();
	}
	else if (type === 'html-message') {
		showHtmlMessage();
	}
	else if (type === 'autoclose-timer') {
		showAutoCloseTimerMessage();
	}
	else if (type === 'prompt') {
		showPromptMessage();
	}
	else if (type === 'ajax-loader') {
		showAjaxLoaderMessage();
	}
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
	swal("Here's a message!");
}

function showWithTitleMessage() {
	swal("Here's a message!", "It's pretty, isn't it?");
}

function showSuccessMessage() {
	swal("Good job!", "You clicked the button!", "success");
}

function showConfirmMessage() {
	swal({
		title: "Are you sure?",
		text: "You will not be able to recover this imaginary file!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
	}, function () {
		swal("Deleted!", "Your imaginary file has been deleted.", "success");
	});
}

function showCancelMessage(datatype='', dataid='', dataname='', url='', colname='') {
	swal({
		title: "Are you sure you want to delete "+dataname+"?",
		text: "You will not be able to recover it!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#fb483a",
		confirmButtonText: "Delete",
		cancelButtonColor: "#9e9e9e",
		cancelButtonText: "Cancel",
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
		closeOnCancel: false
	}, function (isConfirm) {
		if (isConfirm)
		{
			$.ajax({
				url: url+"admin/delete/",
				type:"POST",
				data:{
					"datatype"	: datatype,
					"dataid"	: dataid,
					"dataname"	: dataname,
					"colname"	: colname,
				},
				success: function (msg2)
				{
					if(msg2==404)
						setTimeout(function () {
							swal({title:"Delete un-successfull!", text:"Cannot delete "+dataname+" with fewer details.", type:"warning", confirmButtonColor: "#fb483a"});
						}, 2000);
					else if(msg2==500)
						setTimeout(function () {
							swal({title:"Delete un-successfull!", text:"An error occured during deleting "+dataname+". Please try after sometime.", type:"error", confirmButtonColor: "#fb483a"});
						}, 2000);
					else if(msg2==1)
						setTimeout(function () {
							swal({title:"Delete Successfull!", text:"Deletion was successfull", type:"success", confirmButtonColor: "#fb483a"}, function () { location.reload(true);});
						}, 2000);
					else
						setTimeout(function () {
							swal({title:"Status unknown!", text:"Don't know what happened. May be an error occured during deleting "+dataname+". Please try after sometime or contact your developer.", type:"warning", confirmButtonColor: "#fb483a"});
						}, 2000);
				}
			});
		}
		else
			swal({title:"Delete Canceled", text:"You saved "+dataname+" for later :)", type:"error", confirmButtonColor: "#fb483a"});
	});
}

function showWithCustomIconMessage() {
	swal({
		title: "Sweet!",
		text: "Here's a custom image.",
		imageUrl: "../../images/thumbs-up.png"
	});
}

function showHtmlMessage() {
	swal({
		title: "HTML <small>Title</small>!",
		text: "A custom <span style=\"color: #CC0000\">html<span> message.",
		html: true
	});
}

function showAutoCloseTimerMessage() {
	swal({
		title: "Auto close alert!",
		text: "I will close in 2 seconds.",
		timer: 2000,
		showConfirmButton: false
	});
}

function showPromptMessage() {
	swal({
		title: "An input!",
		text: "Write something interesting:",
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		animation: "slide-from-top",
		inputPlaceholder: "Write something"
	}, function (inputValue) {
		if (inputValue === false) return false;
		if (inputValue === "") {
			swal.showInputError("You need to write something!"); return false
		}
		swal("Nice!", "You wrote: " + inputValue, "success");
	});
}

function showAjaxLoaderMessage() {
	swal({
		title: "Ajax request example",
		text: "Submit to run ajax request",
		type: "info",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true,
	}, function () {
		setTimeout(function () {
			swal("Ajax request finished!");
		}, 2000);
	});
}