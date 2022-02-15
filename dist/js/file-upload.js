URL = window.URL || window.webkitURL;
var off = "<svg viewBox='0 0 24 24' fill='#bdbac2' id='dark' style='-webkit-user-select: none;margin: 5% 20%;cursor: pointer; text-align: center; height: 50px; width: 60%!important;'><g><path d='M1.626 17.87c.125 0 .253-.03.37-.098.36-.205.485-.663.28-1.023-.355-.627-.544-1.343-.544-2.07 0-2.218 1.732-4.02 3.913-4.172.018.282.046.564.096.84.067.36.383.614.738.614.045 0 .09-.004.136-.012.407-.074.678-.465.604-.873-.062-.34-.094-.69-.094-1.04 0-3.204 2.606-5.81 5.81-5.81.58 0 1.15.085 1.702.253.394.123.814-.103.937-.498.12-.396-.103-.815-.5-.937-.69-.21-1.41-.318-2.14-.318-3.673 0-6.714 2.727-7.225 6.262-3.04.118-5.475 2.62-5.475 5.69 0 .986.256 1.958.74 2.81.138.243.39.38.653.38zm18.554-6.802c.03-.312.063-.78.063-1.032 0-.59-.07-1.177-.21-1.745-.1-.4-.503-.645-.907-.55-.402.1-.648.506-.55.908.11.45.167.92.167 1.388 0 .203-.03.615-.055.888-2.067.132-3.816 1.567-4.306 3.603-.097.402.15.808.555.904.397.094.808-.15.904-.554.352-1.46 1.647-2.48 3.15-2.48 1.788 0 3.242 1.455 3.242 3.242s-1.454 3.24-3.24 3.24H8.454c-.414 0-.75.336-.75.75s.336.75.75.75H18.99c2.615 0 4.742-2.126 4.742-4.74 0-2.2-1.514-4.038-3.55-4.57zm.878-8.848c-.293-.293-.768-.293-1.06 0l-19 19c-.294.293-.294.768 0 1.06.145.147.337.22.53.22s.383-.072.53-.22l19-19c.293-.293.293-.767 0-1.06z'></path></g></svg>";
var audio = document.getElementById('audio1');
function retryUpload(fdata) {
	$.ajax({
			url: "image-upload?L_lUUa__mm_jqj93hfbLQfnfjb_kqknc",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				if (response==off) {retryUpload(fdata)} else{$('.avatar-xl').attr('src', url);}
			},
			error: function (jqxhr, status, errorMessage) {
				retryUpload(fdata);
			}
		});
}
function retryImageInput(fdata, url) {
	$.ajax({
			url: "cloud-my-image?L_wejUwh_kekKKQnekWhvueqmvn99y",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				//console.log(response);
				if (response==off) {retryImageInput(fdata);} else{$('#active-unsent').children('.message:first-of-type').remove();$('#active-message-box').append("<div class='message me'><div class='text-main'> <div class='text-group me'> <div class='text me'><p id='exec'><div class'preview'><img src=\""+url+"\" style='max-height: 200px;max-width: 250px;aspect-ratio: auto;'></div></p></div></div><span><i class='material-icons'>check</i>"+response+"</span></div></div>");$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true }); audio.play();U__wjbb_WoXomqg0gWenL0tC6_flf();}
			},
			error: function (jqxhr, status, errorMessage) {
				retryImageInput(fdata, url);
			}
		});
}
function retryFileInput(fdata, url) {
	$.ajax({
			url: "cloud-my-file?Lejj_kwkluJgUhhKnnwm2__ehmLQL",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				//console.log(response);
				if (response==off) {sweetAlert("Oops...","Connection Error !!","error");retryFileInput(fdata, url);} else{$('#active-unsent').children('.message:first-of-type').remove();$('#active-message-box').append("<div class='message me'><div class='text-main'> <div class='text-group me'> <div class='text me'> <div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a href='"+url+"'>"+file.name+"</a></h5> <span>"+file.size/1000+"kb Document</span> </div> </div> </div></div><span><i class='material-icons'>check</i>"+response+"</span> </div> </div>");$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true }); audio.play();U__wjbb_WoXomqg0gWenL0tC6_flf();}
			},
			error: function (jqxhr, status, errorMessage) {
				retryFileInput(fdata, url);
			}
		});
}
$("#my-img-input").on("change", function(e){
	files = this.files;
	console.log(files);	
	var fdata = new FormData();
	$.each(files, function(i, file) {
		fdata.append("file", file);
		var url = URL.createObjectURL(file);
		$.ajax({
			url: "image-upload?L_lUUa__mm_jqj93hfbLQfnfjb_kqknc",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				if (response==off) {sweetAlert("Oops...","Connection Error !!","error"); retryUpload(fdata, url)} else{$('.avatar-xl').attr('src', url);}
			},
			error: function (jqxhr, status, errorMessage) {
				sweetAlert("Oops...","Connection Error !!","error");				
				//console.log(errorMessage);
				retryUpload(fdata, url);
			}
		});
	});
});
$("#image-active-input").on("change", function(e){
	files = this.files;
	//console.log(files);	
	var fdata = new FormData();
	var recipient = $('#active-friend-status').attr('recipient');
	$.each(files, function(i, file) {
		fdata.append("file", file);
		fdata.append("recipient", recipient);
		var url = URL.createObjectURL(file);
		//console.log(url);
		$('#active-unsent').append("<div class='message me zoomInLeft'><div class='text-main'> <div class='text-group me'> <div class='text me' style=\"background: transparent;\"> <div class'preview'><img src=\""+url+"\" style='max-height: 200px;max-width: 250px;aspect-ratio: auto;'></div> </div></div><span><i class=\"material-icons\">cloud</i></span> </div> </div>");
		$("#content").animate({scrollTop: 10000 }, 'slow');
		$.ajax({
			url: "cloud-my-image?L_wejUwh_kekKKQnekWhvueqmvn99y",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				//console.log(response);
				if (response==off) {sweetAlert("Oops...","Connection Error !!","error"); retryImageInput(fdata, url);} else{$('#active-unsent').children('.message:first-of-type').remove();$('#active-message-box').append("<div class='message me'><div class='text-main'> <div class='text-group me'> <div class='text me' style=\"background: transparent;\"><p id='exec'><div class'preview'><img src=\""+url+"\" style='max-height: 200px;max-width: 250px;aspect-ratio: auto;'></div></p></div></div><span><i class='material-icons'>check</i>"+response+"</span></div></div>");$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true }); audio.play();U__wjbb_WoXomqg0gWenL0tC6_flf();}
			},
			error: function (jqxhr, status, errorMessage) {
				sweetAlert("Oops...","Connection Error !!","error");				
				//console.log(errorMessage);
				retryImageInput(fdata, url);
			}
		});
	});
});
$("#file-active-input").on("change", function(e){
	files = this.files;
	//console.log(files);	
	var fdata = new FormData();
	var recipient = $('#active-friend-status').attr('recipient');
	$.each(files, function(i, file) {
		fdata.append("file", file);
		fdata.append("recipient", recipient);
		fdata.append("file-name", file.name);
		fdata.append("file-size", file.size/1000);
		var url = URL.createObjectURL(file);
		//console.log(url);
		$('#active-unsent').append("<div class='message me zoomInLeft'><div class='text-main'> <div class='text-group me'> <div class='text me'> <div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a href='"+url+"'>"+file.name+"</a></h5> <span>"+file.size/1000+"kb Document</span> </div> </div> </div></div><span><i class=\"material-icons\">cloud</i></span> </div> </div>");
		$("#content").animate({scrollTop: 10000 }, 'slow');
		$.ajax({
			url: "cloud-my-file?Lejj_kwkluJgUhhKnnwm2__ehmLQL",
			type: "POST",
			data: fdata, //add the FormData object to the data parameter
			processData: false, //tell jquery not to process data
			contentType: false, //tell jquery not to set content-type
			success: function (response, status, jqxhr) {
				//console.log(response);
				if (response==off) {sweetAlert("Oops...","Connection Error !!","error");retryFileInput(fdata, url);} else{$('#active-unsent').children('.message:first-of-type').remove();$('#active-message-box').append("<div class='message me'><div class='text-main'> <div class='text-group me'> <div class='text me'> <div class='attachment'> <button class='btn attach'><i class='material-icons md-18'>insert_drive_file</i></button> <div class='file'> <h5><a href='"+url+"'>"+file.name+"</a></h5> <span>"+file.size/1000+"kb Document</span> </div> </div> </div></div><span><i class='material-icons'>check</i>"+response+"</span> </div> </div>");$('.all-discussions').load('discussions?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim.php?%242y%2410%24W070XU3fZlPyZ1%2FjOEbrWOJM.ECEVbMqafn%2F6w7L7lUTSFiTqeyim', {'fetch': true }); audio.play();U__wjbb_WoXomqg0gWenL0tC6_flf();}
			},
			error: function (jqxhr, status, errorMessage) {
				sweetAlert("Oops...","Connection Error !!","error");
				//console.log(errorMessage);
				retryFileInput(fdata, url);
			}
		});
	});
});