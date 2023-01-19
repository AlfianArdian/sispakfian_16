const flashData = $(".flash-data").data("flashdata");

if (flashData) {
	Swal({
		title: "Sip, Data ",
		text: "Berhasil " + flashData,
		type: "success"
	});
}

// tombol-hapus
$(".tombol-hapus").on("click", function(e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal({
		title: "Apakah anda yakin",
		text: "data ini akan dihapus",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus Data!"
	}).then(result => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

//tombol logout
$(".tombol-logout").on("click", function(e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal({
		title: "Yakin mau logout",
		text: "Lanjutkan?",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Logout!"
	}).then(result => {
		if (result.value) {
			document.location.href = href;
		}
	});
});
