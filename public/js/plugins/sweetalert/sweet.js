// Alert Konfrimasi hapus data
$(".tombolhapus").on("click", function(e) {
    e.preventDefault();
    const href = $(this).attr("href");
    Swal.fire({
        title: "Anda Yakin ?",
        text: "Data yang telah dihapus tidak akan kembali lagi !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Hapus Data"
    }).then(result => {
        if (result.value) {
            document.location.href = href;
        }
    });
});


// Script Loading penjadwalan 
const showLoading = function() {
    Swal.fire({
    title: 'Mohon Tunggu Sebentar',
    allowEscapeKey: false,
    allowOutsideClick: false,
    timer: false,
    onOpen: () => {
        Swal.showLoading();
        },
    text: "Sistem sedang menyimpan data..!",
    })
  };

  document.getElementById("fire")
    .addEventListener('click', (event) => {
      showLoading();
    });