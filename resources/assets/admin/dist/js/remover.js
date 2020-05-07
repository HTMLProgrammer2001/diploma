function remover(deleteForm, item){
	console.log(1);

	$(deleteForm).on('click', function (e) {
		console.log(2);

		e.preventDefault();

		$.ajax({
			url: $(this).attr('data-url'),
			type: 'delete',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
			},
			success: () => {
				let itemElement = $(e.target).closest(item);

				if(!itemElement)
					return;

				itemElement.fadeOut(300, () => {
					itemElement.remove();
				});
			},
			error: (e) => {
				alert(e.message);
			}
		});
	});
}

window.remover = remover;
