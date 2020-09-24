$(function () {
	$('.js-basic-example').DataTable({
		responsive: true
	});

	//Exportable table
	$('.js-exportable').DataTable({
		dom: 'Bfrtip',
		responsive: true,
		buttons: [
			{
				extend: 'copy',
				footer: true,
				exportOptions: {
					columns: ":not(:last-child)"
				}
			},
			{
				extend: 'csv',
				footer: true,
				exportOptions: {
					columns: ":not(:last-child)"
				}
			},
			{
				extend: 'excel',
				footer: true,
				exportOptions: {
					columns: ":not(:last-child)"
				}
			},
			{
				extend: 'pdf',
				footer: true,
				exportOptions: {
					columns: ":not(:last-child)"
				}
			},
			{
				extend: 'print',
				footer: true,
				exportOptions: {
					columns: ":not(:last-child)"
				}
			}
		],
		language: {
			search: "Quick Search:",
			searchPlaceholder: "Type here..."
		}
	});
});