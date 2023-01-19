$(document).ready(function () {
	// var base_url = localStorage.getItem("base_url");
	// var base_url = "http://localhost:8080/sispakfian_12/";
	var base_url = "http://localhost/sispakfian_16/";

	var which;
	$("button").click(function () {
		which = $(this).attr("id");
	});

	// TAMBAH GEJALA
	$("#tambah_gejala").submit(function (e) {
		e.preventDefault();
		var formData = $("#tambah_gejala").serialize();
		var validateUrl = base_url + "Gejala/validateTambahGejala";
		$.ajax({
			url: validateUrl,
			method: "POST",
			data: formData,
			dataType: "json",

			success: function (data) {
				if (data.code == 1) {
					if (data.kode_error != "") {
						$("#kode").addClass("is-invalid");
						$("#invalid_kode").html(data.kode_error);
					} else {
						$("#kode").removeClass("is-invalid");
						$("#kode").addClass("is-valid");
						$("#invalid_kode").html("");
					}
					if (data.gejala_error != "") {
						$("#gejala").addClass("is-invalid");
						$("#invalid_gejala").html(data.gejala_error);
					} else {
						$("#gejala").removeClass("is-invalid");
						$("#gejala").addClass("is-valid");
						$("#invalid_gejala").html("");
					}
					if (data.nama_penyakit_error != "") {
						$("#nama_penyakit").addClass("is-invalid");
						$("#invalid_nama_penyakit").html(data.nama_penyakit_error);
					} else {
						$("#nama_penyakit").removeClass("is-invalid");
						$("#nama_penyakit").addClass("is-valid");
						$("#invalid_nama_penyakit").html("");
					}
					if (data.bobot_error != "") {
						$("#bobot").addClass("is-invalid");
						$("#invalid_bobot").html(data.bobot_error);
					} else {
						$("#bobot").removeClass("is-invalid");
						$("#bobot").addClass("is-valid");
						$("#invalid_bobot").html("");
					}
				} else if (data.code == 0) {
					$("#kode").removeClass("is-invalid");
					$("#invalid_kode").html("");
					$("#kode").addClass("is-valid");

					$("#gejala").removeClass("is-invalid");
					$("#invalid_gejala").html("");
					$("#gejala").addClass("is-valid");

					$("#nama_penyakit").removeClass("is-invalid");
					$("#invalid_nama_penyakit").html("");
					$("#nama_penyakit").addClass("is-valid");

					$("#bobot").removeClass("is-invalid");
					$("#invalid_bobot").html("");
					$("#bobot").addClass("is-valid");

					if (which == "save") {
						save(formData);
					}
				}
			},
		});
		//save
		function save(data) {
			var saveUrl = base_url + "Gejala/tambahGejala";
			$.ajax({
				url: saveUrl,
				method: "POST",
				data: data,
				dataType: "json",

				success: function (data) {
					if (data.code == 200) {
						Swal({
							position: "center",
							text: data.msg,
							type: "success",
							timer: 1500,
						});
						$("#newMenuModal").modal("hide");
						setInterval(() => {
							location.reload();
						}, 2000);
					} else if (data.code == 404) {
						Swal({
							position: "center",
							text: data.msg,
							type: "error",
							timer: 1500,
						});
					}
				},
			});
		}
	});
});
