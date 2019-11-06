const currentPage = window.location.pathname; //Page url

//class like OR unlike & id =  post id 
NProgress.configure({ //Customize NProgress
	easing: 'ease',
	speed: 500
});

$(document).ready(() => { //Document is ready

	// $(window).on('load', ()=> { //Show Page Data
	// 	$('nav').fadeIn(200);
	// 	$('#main').fadeIn(200);
	// 	$('footer').fadeIn(200);
	// });l

	$(() => { //Show Page Loading When Ajax Requested
		$(document)
			.ajaxStart(NProgress.start)
			.ajaxStop(NProgress.done);
	});

	if (currentPage.indexOf('admnPnl') == -1) { //Show All Posts on Page
		showPost();
	}

	$('.toast').toast('show'); //Show Toast on Page
	$('[data-toggle="tooltip"]').tooltip(); //Show Tooltip on Page
	// $('.collapse').on('click', (event) => { //Show Select Menu in Dropdown
	// 	event.stopPropagation();
	// });
	// $('form').submit(e => { //Stop Form Submition
	// 	e.preventDefault();
	// });

	$('#postImg').change(e => { //Check Image Type
		e.preventDefault();
		window.imgFile = this.files[0];
		const imgTypes = ['image/png', 'image/jpeg'];
		if (document.querySelector('#postImg').files.length != 0) { //File Is Selected
			if ($.inArray(imgFile.type, imgTypes) < 0) {
				$(this).before('<span class="error" data-toggle="tooltip" title="Please Select Image!"></span>');
				$('.error').tooltip('show'); //Show Tooltip 
				setTimeout(() => { //Hide After 1500ms
					$('.error').tooltip('dispose');
				}, 1500);
			}
		}
	});

	//Create New Post
	$('#createPost').click(e => {
		e.preventDefault();

		$('#createPostForm').validate({
			// rules: {
			// 	postCnt: {
			// 		require_form_group: [1, '.validGroup'],
			// 		minlength: 3
			// 	},
			// 	postCnt2: {
			// 		require_form_group: [1, '.validGroup']
			// 	}
			// }
		});

		$('#createPostForm').ajaxForm({
			url: "actions",
			data: {
				'action': "createPost"
			},
			cache: false,
			beforeSubmit: () => {
				console.log('Validate Form');
				return $('#createPostForm').valid();
			},
			success: response => {
				console.log(response);
				showPost();
			}
		}).submit();
	});





	// $('#createPost').click(function (e) {
	// 	e.preventDefault();
	// 	$('#createPostForm').ajaxForm({
	// 		url: "actions",
	// 		data: {
	// 			'action': "createPost"
	// 		},
	// 		cache: false,
	// 		success: function (response) {
	// 			console.log(response);
	// 			showPost();
	// 		}
	// 	}).submit();
	// });




	$('#signInModal').on('click', '#signin', () => {

		$('#signInForm').validate({
			rules: {
				uname: {
					required: true,
					minlength: 5,
					regex: /^[A-z0-9.@]+$/
				},
				upass: {
					required: true,
					minlength: 3
				}
			},
			messages: {
				uname: {
					required: "Hey ! Your Username is Importent for me, Please tell me.",
					minlength: "Oops! It's too short.",
					regex: "Oops! You miss Typed."
				},
				upass: {
					required: "Your Password is a Secret, Please Tell me.",
					minlength: "Oops! It's too short."
				},

			}
		});


		if ($('#signInForm').valid()) {
			const uname = cleanString($('#uname').val());
			const upass = $('#upass').val();
			console.log(uname + ' ' + upass);

			$.ajax({
				type: "get",
				url: "actions",
				data: {
					'action': "signIn",
					'uname': uname,
					'upass': upass
				},
				cache: false,
				success: response => {
					console.log('Actions is Success');
					console.log(response);

					$('#myPopup').html(response);

					$(this).closest('form').find('input[type=text],input[type=password],input[type=email],input[type=file],textarea').val("");

					$('#signInModal').modal('toggle');
					setTimeout(() => {
						location.href = ""
					}, 1800);

				}
			});
		} else {
			console.log('Invalid Form');
		}
	});

	//Post Action (user)
	$('#posts').on('click', '.click', function (e) {
		e.preventDefault();
		const pid = $(this).attr('id').split('_');
		console.log(pid);
		$.ajax({
			type: "get",
			url: "actions",
			data: {
				'action': pid[0],
				'pid': pid[1]
			},
			cache: false,
			success: response => {
				console.log('Your Action - ' + pid);
				showPost();
			}
		});
	});

	$('#profile').load("actions", {
		'action': "profile"
	});


	//Clean String Function
	function cleanString(String) {
		return String.replace(/ |`|~|!|#|\$|%|\^|&|\*|\(|\)|\+|=|\[|\]|{|}|:|;|'|"|\||\\|<|,|>|\/|\?|/g, '').toLowerCase();
	}

	function notify(type, title) {
		swal({
			position: 'top-end',
			title: title,
			type: type,
			showConfirmButton: false,
			timer: 1500
		});
	}

	//Show All Posts Using Ajax Function
	function showPost() {
		$.ajax({
			type: "get",
			url: "actions",
			dataType: "html",
			data: {
				'action': "showPosts"
			},
			cache: false,
			success: response => {
				$('#posts').html(response);
			}
		});
	}

	//Create RegExp Rule
	$.validator.addMethod(
		'regex',
		function (value, element, regexp) {
			const reg = new RegExp(regexp);
			return this.optional(element) || reg.test(value);
		},
		"Invalid Input"
	);

});