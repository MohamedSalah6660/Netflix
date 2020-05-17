

$(document).ready(function() {

	let favCount = $('#nav__fav-count').data('fav-count');


	$(document).on('click','.movie__fav-icon' ,function(){
		//used document here to look at the whole page cause
		 // there is disappeared  movies on two sides


		let url = $(this).data('url')
		let movieId = $(this).data('movie-id');
		let is_favored = $(this).hasClass('fw-900');

		toggleFavorite(url, movieId, is_favored);

	});


	$(document).on('click','.movie__fav-btn' ,function(e){
		//used document here to look at the whole page cause
		 // there is disappeared  movies on two sides

		 e.preventDefault();

		let url = $(this).find('.movie__fav-icon').data('url');
		let movieId = $(this).find('.movie__fav-icon').data('movie-id');
		let is_favored = $(this).find('.movie__fav-icon').hasClass('fw-900');

		toggleFavorite(url, movieId, is_favored);
		
	});


	function toggleFavorite(url, movieId, is_favored)
	{

		!is_favored ? favCount++ : favCount--;

		// if (!is_favored) {
		// 	favCount++;
		// }else{
		// 	favCount--;
		// }

		favCount > 9 ? $('#nav__fav-count').html('9+') : $('#nav__fav-count').html(favCount);

		$('.movie-' + movieId).toggleClass('fw-900');

		if($('.movie-'+ movieId).closest('.favorite').length)
		{

			$('.movie-'+ movieId).closest('.movie').remove();
		}


		$.ajax({
			url: url,
			method:'POST',

			success:function(){

			},

		});
	}
});

