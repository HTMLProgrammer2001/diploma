function table({paginator, content, url, form, sort, callback}){
	if($(form)) {
		$(form).off('submit');

		$(form).on('submit', function (e) {
			e.preventDefault();

			$(paginator).find('.active').toggleClass('active');
			$(paginator).find('.page-link').first().addClass('active');

			getData(url, 1, content, new FormData(this));
		});
	}

	if($(sort)) {
		$(sort).off('click');

		$(sort).on('click', function (e) {
			let state = +$(this).attr('data-state');
			state = (state + 1) % 3;

			switch (state) {
				case 0:
					$(this).addClass('opacity-5').addClass('fa-sort-amount-asc').removeClass('fa-sort-amount-desc');
					break;
				case 1:
					$(this).removeClass('opacity-5');
					break;
				default:
					$(this).removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
			}

			$(this).attr('data-state', state);

			getData(url, 1, content, new FormData($(form)[0]));

			$(this).off('click');
		});
	}

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

	function addSortData(formData){
		let sortValues = $(sort).filter(':not([data-state=0])');

		sortValues.each((index, elem) => {
			formData.append($(elem).attr('data-name'), $(elem).attr('data-state'));
		});
	}

	function getData(url, page, table, data){
		addSortData(data);

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

window.table = table;
