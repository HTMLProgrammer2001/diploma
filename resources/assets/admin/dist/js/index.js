$(document).ready(function () {
    $('.calendar').datepicker({
		format: 'dd.mm.yyyy'
	});
    $('.select2').select2();

    //export users
    if($('.export-users')){
    	$('.export-users').on('click', function (e) {
    		e.preventDefault();

    		if($('.user-form')){
    			let data = new FormData($('.user-form')[0]);

    			$.ajax({
					url: $(this).attr('href'),
					type: 'post',
					data,
					contentType: false,
					processData: false,
					responseType: 'blob',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
					},
					success: function(response, status, xhr) {
						let a = document.createElement("a");
							a.href = xhr.responseText;
							a.download = 'report.xlsx';
							document.body.appendChild(a);
							a.click();
						}
				});
			}
		});
	}
});
