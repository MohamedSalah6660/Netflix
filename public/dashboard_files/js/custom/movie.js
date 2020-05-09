$(document).ready(function() {
	

	$('#file-input').on('change', function(){

		$('#upload-wrapper').css('display', 'none');
		$('#movie-properties').css('display', 'block');


		var movie = this.files[0];

		var movieName = movie.name.split('.').slice(0, -1).join('.');

		var url = $(this).data('url');

		var movieId = $(this).data('movie-id');

		$('#movie-name').val(movieName);

		console.log(url);
		var formData = new  FormData();

		formData.append('movie_id' , movieId);
		formData.append('name' , movieName);
		formData.append('movie' , movie);


		$.ajax({
			url:url,
			data: formData,
			method: 'POST',
			processData: false,
			contentType: false,
			cache: false,

			success: function(movieBeforeProcessing){


				var interval = setInterval(function(){

					$.ajax({

						url:`/dashboard/movies/${movieBeforeProcessing.id}`,

						method:'GET',

						success:function(movieWhileProcessing){

							$('#upload-status').html('Processing');

							$('#upload-progress').css('width', movieWhileProcessing.percent + '%');
							$('#upload-progress').html(Math.round(movieWhileProcessing.percent) + '%');

						
							if(movieWhileProcessing.percent == 100)
							{
								//  To avoid send request many time and exauste the server
								clearInterval(interval);
							$('#upload-status').html('Done Processing');
							$('#upload-progress').parent().css('display', 'none');
							$('#submit-btn').css('display', 'block');


							}

						},

					});



				},50)

			},

			xhr: function(){

				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt){

				if(evt.lengthComputable){

					var percentComplete = Math.round(evt.loaded / evt.total * 100 ) + "%";
					$('#upload-progress').css('width', percentComplete).html(percentComplete)

				}
				}, false);

				return xhr;
			},
		
	});

});

});

	// image preview
$(".image").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});


$(".poster").change(function () {

    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.poster-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }

});