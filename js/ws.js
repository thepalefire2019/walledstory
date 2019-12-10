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

//delete
jQuery(document).ready(function($){
	$('.delete').click( function(e){
		$('.delete').removeClass('delete-this-one');
		$(this).addClass( 'delete-this-one' );
		var id = $(this).data('id');
		if( $('.delete').hasClass( 'delete-this-one' ) ){
			$.ajax({
				beforeSend : function(xhr){
					xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
				},
				url: wsdata.root_url + '/wp-json/wp/V2/ws_english/'+ id,
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

//create

jQuery(document).ready(function($){
	$('#save-post').click( function(e){
		var title 			= $('#post-title').val();
		var content 		= $('#post-content').val();
		var category 		= $('#post-category').val();
		var img 			= $('#post-img-id').val();
		var ournewpostobj 	= {
			'title' 			: title,
			'content'			: content,
			'status'			: 'publish',
			'english_category' 	:[category],
			'featured_media' 	: img 
		}

		$.ajax({
				beforeSend : function(xhr){
					xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
				},
				url: wsdata.root_url + '/wp-json/wp/V2/ws_english/',
				type : 'POST',
				data : ournewpostobj,
				success : function( response ){
					console.log( 'Success' );
					console.log( response );
					location.reload();
				},
				error : function( response ){
					console.log( response );
				}
			});
	} );
});

// CRUD operation 



// var oureditpostobj = {
// 			'title' 	: title,
// 			'content'	: content
// 		}
// $.ajax({
// 				beforeSend : function(xhr){
// 					xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
// 				},
// 				url: wsdata.root_url + '/wp-json/wp/V2/ws_english/'+ id,
// 				type : 'POST',
// 				data : oureditpostobj,
// 				success : function( response ){
// 					console.log( 'Success' );
// 					console.log( response );
// 				},
// 				error : function( response ){
// 					console.log( response );
// 				}
// 			});



// image from front end. Featured Image

jQuery(document).ready( function(){
	function media_upload( button_class, index) {
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;

		jQuery('body').on('click',button_class+index, function(e) {
		    var button_id ='#'+jQuery(this).attr('id');
		    /* console.log(button_id); */
		    var self = jQuery(button_id);
		    var send_attachment_bkp = wp.media.editor.send.attachment;
		    var button = jQuery(button_id);
		    var id = button.attr('id').replace('_button', '');
		    _custom_media = true;
		    wp.media.editor.send.attachment = function(props, attachment){
		        if ( _custom_media  ) {
		        	
		           jQuery('.img_url_'+index).val(attachment.id);
		           jQuery('.pro_img_'+index).attr("src", attachment.url);
		        } else {
		            return _orig_send_attachment.apply( button_id, [props, attachment] );
		        }
		    }
		    wp.media.editor.open(button);
		    return false;
		});
	}

		
	media_upload( ".select-image-" , 1);
		
		
	
	});


//custom profile picture from front end
jQuery(document).ready(function($){

	 var mediaUploader;
	 $('#upload-button').on('click',function(e){

	 	e.preventDefault();
	 	if(mediaUploader){
	 		mediaUploader.open();
	 		return;
	 	}

	 	mediaUploader = wp.media.frames.file_frame = wp.media({
	 		title :'Choose a Profile Picture', 
	 		button : {
	 			text : 'Choose Picture'
	 		},
	 		multiple : false
	 	});

	 	mediaUploader.on('select',function(){
	 		attachment = mediaUploader.state().get('selection').first().toJSON();
	 		$('#profile-picture').val(attachment.url);
	 		$('#profile-picture-preview').css('background-image','url('+attachment.url +')');
	 	});

	 	mediaUploader.open();
	 });

	 $( "#remove-picture").on('click',function(e){
	 	e.preventDefault();
	 	var answer = confirm("Are you sure you want to remove your profile picture?");
	 	
	 	if( answer==true){
	 		$('#profile-picture').val('');
	 		$('.tg-general-form').submit();
	 	}else{

	 	}
	 	return;
	 });
});



