$(document).ready(function() {
	var myId = 4;
var total='';
 $.get("fetchMyClasses.php", "", function (response){
				myClasses=JSON.parse(response);
						/*

						Returned Json from PHP
						{
							"FirstName": "Michael",
							"LastName": "Gousie",
							"ClassId": "1",
							"ClassName": "Senior Seminar",
							"ClassNumber": "Comp 401"
						  }

						*/
				for (i = 0; i < myClasses.length; i++){
					$(".checkbox").append('<input type="checkbox" name="classopt[]" value='+myClasses[i].ClassId+'>'+myClasses[i].ClassName+'</input><br>');
			var addition='<input type="checkbox" name="classopt[]" value='+myClasses[i].ClassId+'>'+myClasses[i].ClassName+'</input><br>';
			 total=total+addition;
			}
})


$("#add").click(function(){
 $(".form").append('<form id="form" action="#">\
<input type="text" name="name" placeholder="Enter Film Name"><br>\
<input type="text" name="dueDate" placeholder="Due Date"><br>\
 <input type="text" name="runtime" placeholder="runtime">\
<div class=checkbox>'+total+'</div>\
<input type="file" id="image"  name="image" >\
 <button class="btn btn-sm btn-info upload" type="submit">Upload</button>\
 <button type="button" class="btn btn-sm btn-danger cancel">Cancel</button>\
<div class="progress progress-striped active">\
<div class="progress-bar" style="width:0%"></div>\
</div>\
</form>');});
	$("#form").validate({
				rules: {
			 dueDate: {
						   required: true,
						   date: true
								 },
					image: {
						required: true,
						extension: "mp4"

					},
			name: {
						required: true,
						minlength: 5
			} ,
	"classopt[]": { required: true }
				},
				messages: {
			dueDate: {
						   required: "Please enter a date",
						   date: "Please enter a vaild date"
								 },
					image: {
						extension:"Please select only  mp4, gif, ogg, and flv  files"
					},
			name: {
						required: "Please enter Film name",
						minlength: "Please enter minimum 5 characters"
					}
				}
			});
			   

	$('.cancel-all').click(function(){
		//submit all form
		$('form .cancel').click();
	});
	$(document).on('submit','upload-form',function(response){
		response.preventDefault();
		$form = $(this);
		uploadVideo($form);
	});


	function uploadVideo($form){
		var $video=$form.children("input").filter('#image');
		var fsize = $video[0].files[0].size;
		var ftype =$video[0].files[0].type;
		if($video.val()!="" && fsize<$system_max_fsize){
			$form.find('.progress-bar').removeClass('progress-bar-success').removeClass('progress-bar-danger');
			var formdata = new FormData($form[0]); //formelement
			var request = new XMLHttpRequest();
			//progress event...
			request.upload.addEventListener('progress',function(e){
				var percent = Math.round(e.loaded/e.total * 100);
				$form.find('.progress-bar').width(percent+'%').html(percent+'%');

			});
			//progress completed load event
			request.addEventListener('load',function(e){
				$form.find('.progress-bar').addClass('progress-bar-success').html('upload completed....');
			});

			//open pipe to php
			request.open('post', 'uploader.php');
			//send data to php
			request.send(formdata);
		}
		else if($fize > $system_max_fsize){
			alert("no video selected to upload or File selected is too large");
		}
		$form.on('click','.cancel',function(){
			request.abort();
			$form.find('.progress-bar')
				.addClass('progress-bar-danger')
				.removeClass('progress-bar-success')
				.html('upload aborted...');

		});
	}
	alert("finished JS");
}); // End of Document Ready
