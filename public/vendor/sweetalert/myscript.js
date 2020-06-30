const status = $('.status').data('status');

if (status) {
    Swal.fire({
        title: 'SUKSES',
        text: 'Selamat' + status,
        type: 'success'
    });
}
$nil = 0;
$('.tombol-hapus').on('submit', function (e) {
    if ($nil == 0) {
        e.preventDefault();

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak bisa kembali!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.value) {
                $nil = 1;
                $(this).submit();
                // document.location.href = href;
            }
        });
    }

});
