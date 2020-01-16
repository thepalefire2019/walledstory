

	// follow button
	jQuery(document).ready(function($){
		$(".click-follow").on('click', function(e){
			var author_id = $(this).data('author_id');
			var follow_id = $(this).data('follow_id');
			var old_followers_no = parseInt($('.js-followers').html(), 10);

			//alert(old_followers_no);
			if( $(this).attr('data-followexist') == 'yes' ){
				//unfollow
				//alert(follow_id);
				$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url : wsdata.root_url +'/wp-json/ws/V1/follow',
					data : {
						'follow_id' : follow_id
					},
					type : 'DELETE',
					success : function( response ){
						var new_followers_no = old_followers_no-1;
						$('.js-followers').html(new_followers_no);
						$('.click-follow').attr("data-followexist", 'no');
						$('.click-follow').removeAttr("data-follow_id");
						$('.click-follow').html('Follow');
						$('.click-follow').css('background', '#fff');
						$('.click-follow').css('color', '#000');
					},
					error : function ( response ){console.log( response )}

				});
			}else{
				//follow
				$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url : wsdata.root_url +'/wp-json/ws/V1/follow',
					type : 'POST',
					data :{
						'author_id' : author_id
					},
					success : function( response ){
						var new_followers_no = old_followers_no+1;
						//alert(new_followers_no);
						console.log(response);
						$('.click-follow').attr("data-followexist", 'yes');
						$('.click-follow').attr("data-follow_id", response);
						$('.click-follow').html('Unfollow');
						$('.click-follow').css('background', 'var(--theme-color-dark)');
						$('.click-follow').css('color', '#fff');
						$('.js-followers').html(new_followers_no);
					},
					error : function ( response ){console.log( response )}
				});
			}
		});
	});

	//if not logged in
	jQuery(document).ready(function($){
		$(".click-follow-logged-off").on('click', function(e){
			alert("Please Log in To Follow");
		});
	})
	jQuery(document).ready(function($){
		$(".logout-like-box").on('click', function(e){
			alert("Please Log in To Like");
		});
	})
	// follow button

	// like button
	jQuery(document).ready(function($){
		$(".like-box").on('click', function(e){
			var blog_id = $(this).data('blog');
			var like_id = $(this).data('like');
			if( $(this).attr('data-exist') == 'yes' ){
				//delete like

				$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url : wsdata.root_url +'/wp-json/ws/V1/like',
					data : {
						'like_id' : like_id
					},
					type : 'DELETE',
					success : function( response ){
						$('.fa-heart').css('color', '#fff');
						var old_like_count = parseInt( $('.present-like-count').html() , 10 );
						var new_like_count = old_like_count - 1;
						$('.present-like-count').html( new_like_count );
						$('.like-box').attr("data-like", '')
						$('.like-box').attr("data-exist", 'no');
					},
					error : function ( response ){console.log( response )}
				});
			}else{
				//create like
				$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url : wsdata.root_url +'/wp-json/ws/V1/like',
					type : 'POST',
					data :{
						'blog_id' : blog_id
					},
					success : function( response ){
						$('.fa-heart').css('color', 'red');
						var old_like_count = parseInt( $('.present-like-count').html() , 10 );
						var new_like_count = old_like_count + 1;
						//alert(new_like_count);
						$('.present-like-count').html( new_like_count );
						$('.like-box').attr("data-like", response);
						$('.like-box').attr("data-exist", 'yes');
						console.log(response);
					},
					error : function ( response ){console.log( response )}
				});
				
			}
		});
	});

	// like button



	// CRUD operation 

	//delete
	jQuery(document).ready(function($){
		$('#delete-blog').click( function(e){
			$('#delete-blog').removeClass('delete-this-one');
			$(this).addClass( 'delete-this-one' );
			var id = $(this).data('id');
			if( $('#delete-blog').hasClass( 'delete-this-one' ) ){
				if( confirm( 'Are You Sure, you want to delete?' ) ){
					$.ajax({
						beforeSend : function(xhr){
							xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
						},
						url: wsdata.root_url + '/wp-json/wp/V2/ws_blog/'+ id,
						type : 'DELETE',
						success : function( response ){
							console.log( 'Success' );
							console.log( response );
							window.location = wsdata.root_url;
						},
						error : function( response ){
							console.log( response );
						}
					}); //ajax
				} // confirm
				
			}
		});

	});

	//create blog

	jQuery(document).ready(function($){
		$('#save-post').click( function(e){
			var title 			= $('#post-title').val();
			var content 		= $('#post-content').val();
			var category 		= $('#post-category').val();
			var img 			= $('#post-img-id').val();
			var template 		= $('#post-template').val();

			if( img == null ){
				var img = '134';
			}
			if( template ==0 ){
				temp_val = null;
			}
			if( template == 1 ){
				temp_val = 'post-template/poem.php'
			}
			if( template == 2 ){
				temp_val = 'post-template/sports.php'
			}

			var ournewpostobj 	= {
				'title' 			: title,
				'content'			: content,
				'status'			: 'publish',
				'blog_category' 	: [category],
				'featured_media' 	: img,
				'template'			: temp_val
			}

			$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url: wsdata.root_url + '/wp-json/wp/V2/ws_blog/',
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
				}); //ajax
		} );
	});

	//edit blog

	jQuery(document).ready(function($){
		$('#edit-post').click( function(e){
			var id 				= $('#blog_id').val();
			var title 			= $('#post-title-edit').val();
			var content 		= $('#post-content-edit').val();
			var category 		= $('#post-category-edit').val();
			var img 			= $('#post-img-id-edit').val();
			var oureditpostobj 	= {
				'title' 			: title,
				'content'			: content,
				'status'			: 'publish',
				'blog_category' 	:[category],
				'featured_media' 	: img 
			};
			$.ajax({
					beforeSend : function(xhr){
						xhr.setRequestHeader( 'X-WP-NONCE', wsdata.nonce );
					},
					url: wsdata.root_url + '/wp-json/wp/V2/ws_blog/'+ id,
					type : 'POST',
					data : oureditpostobj,
					success : function( response ){
						console.log( 'Success' );
						console.log( response );
						location.reload();
					},
					error : function( response ){
						console.log( response );
					}
				}); // ajax
		});
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
	// 				url: wsdata.root_url + '/wp-json/wp/V2/ws_blog/'+ id,
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


// Mobile menu functionality

	jQuery(document).ready(function($){
		$('.hd-menu').on( 'click', function(e){
			
			if( $(this).hasClass('menu-active') ){
				$('.mobile-menu-screen').hide(500);
				$(this).removeClass('menu-active');
				$('.director').show(500);
			}else{
				$('.mobile-menu-screen').show(500);
				$(this).addClass('menu-active');
				$('.director').hide(500);
			}
			
		} );
	});


// Main Menu Functionality
jQuery(document).ready(function($){
	$('.main-menu').on('click', function(){
		if( $(this).hasClass('main-menu-active') ){
			$('.main-menu-screen').hide(500);
			$(this).removeClass('main-menu-active');
			$('.director').show(500);
			$('.main-menu-img').show(500);
			$('.main-menu-close').hide();
		}else{
			$('.main-menu-screen').show(500);
			$(this).addClass('main-menu-active');
			$('.director').hide(500);
			$('.main-menu-img').hide(500);
			$('.main-menu-close').show();
		}
	});
});



//mobile-search
jQuery(document).ready(function($){
	$('.mobile-search').on('click', function(){
		// $('.mobile-search').removeClass('.mobile-search-active');
		
		if( $(this).hasClass('mobile-search-active') ){
			$('.mobile-search-screen').hide(500);
			$(this).removeClass('mobile-search-active');
			$('.mobile-search-img').show(500);
			$('.mobile-search-img-close').hide(500)
		}else{
			$('.mobile-search-screen').show(500);
			$(this).addClass('mobile-search-active');
			$('.mobile-search-img').hide(500);
			$('.mobile-search-img-close').show(500)
		}
	});
});


//Front page like pop up
jQuery(document).ready(function($){
	$('#front-like').on('click', function(){
		var permalink = $(this).data('link');
		alert('Read The Full Blog To Like');
		window.location = permalink;
	});
});