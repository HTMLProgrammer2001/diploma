function paginate(paginator, content, url){
	getData(url, 1, content);

	$(paginator).find('.page-link').on('click', (e) => {
		e.preventDefault();

		//active page click
		if($(e.target).hasClass('active'))
			return;

		//change items in list
		getData(url, $(e.target).text(), content);

		//remove old active item class
		$(e.target).closest('.paginator').find('.active').toggleClass('active');

		//add active class to this item
		$(e.target).closest('.page-item').addClass('active');
	});

	function getData(url, page, table){
		$(table).empty().html('Загрузка...');

		$.ajax({
			url: url + '?page=' + page,
			type: 'get',
			responseType: 'html'
		})
			.done((data) => {
				$(table).empty().html(data);
			});
	}
}
