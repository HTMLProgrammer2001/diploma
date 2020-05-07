function paginate({paginator, content, url, form, callback}){
	if($(form))
		$(form).one('submit', function (e) {
			e.preventDefault();

			$(paginator).find('.active').toggleClass('active');
			$(paginator).find('.page-link').first().addClass('active');

			getData(url, 1, content, new FormData(this));
		});

	$(paginator).find('.page-link').on('click', (e) => {
		e.preventDefault();

		//active page click
		if($(e.target).hasClass('active'))
			return;

		//change items in list
		let data = {};
		if($(form))
			data = new FormData($(form)[0]);

		getData(url, $(e.target).text(), content, data);

		//remove old active item class
		$(e.target).closest('.paginator').find('.active').toggleClass('active');

		//add active class to this item
		$(e.target).closest('.page-item').addClass('active');
	});

	function getData(url, page, table, data){
		$(table).empty().html('Загрузка...');

		$.ajax({
			url: url + '?page=' + page,
			type: 'post',
			data,
			responseType: 'html',
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="token"]').attr('content'),
				'Pragma': 'no-cache',
				'Cache-Control': 'no-cache'
			}
		})
			.done((data) => {
				$(table).empty().html(data);

				if(callback)
					callback(data);
			});
	}
}

window.paginate = paginate;
