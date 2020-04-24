$(document).ready(() => {
	getData('/admin/users/paginate', 1, '.wrap-content');
});

$('.page-link').on('click', (e) => {
	e.preventDefault();

	//active page click
	if($(e.target).hasClass('active'))
		return;

	//change items in list
	getData('/admin/users/paginate', $(e.target).text(), '.wrap-content');

	//remove old active item class
	$(e.target).closest('.paginator').find('.active').toggleClass('active');

	//add active class to this item
	$(e.target).closest('.page-item').addClass('active');
});
