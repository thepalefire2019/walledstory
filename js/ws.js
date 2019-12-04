// like button
jQuery(document).ready(function($){
	$('#like-btn').click(function(e){
		e.preventDefault();

		var userid = $(this).data('userid');
		var ajaxurl = $(this).data('ajaxurl');
		var old_like = $(this).data('like');
		var postid = $(this).data('postid');

		$.ajax({
			url : ajaxurl,
			type : 'POST',
			data : {
					userid : userid,
					postid : postid,
					action : 'ws_like_ajax'
					},
			error : function( response ){
				console.log( response );
			},
			success : function( response ){ 
				//alert(response);
				if( response == 0 ){
					new_like = old_like +1; 
					$("#like").html(new_like);
					$('#like-btn').attr("disabled", true);

				} else{
					alert( response );
				}//if response == 0
			}//success
		});


	});
});

// like button



// CRUD operation 
jQuery(document).ready(function($){
	$('.delete').click( function(e){
		$('.delete').removeClass('delete-this-one');
		$(this).addClass( 'delete-this-one' );
		if( $('.delete').hasClass( 'delete-this-one' ) ){
			$.ajax({
				beforeSend : function(xhr){
					xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
				},
				url: wsdata.root_url + '/wp-json/wp/V2/ws_english/13',
				type : 'DELETE',
				success : function( response ){
					console.log( 'Success' );
					console.log( response );
				},
				error : function( response ){
					console.log( response );
				}
			});
		}
	});

});

// CRUD operation 