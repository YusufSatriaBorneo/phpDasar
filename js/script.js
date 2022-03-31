$(document).ready(function() {
    // hilangkan tombol cari
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function() {
        // munculkan loading
        $('.loader').show();

        // ajax menggunakan load
        // $.get('ajax/ajax_mahasiswa.php?keyword=' + $('#keyword').val(), function(data) {
            
        // $.get()

        $.get('ajax/mobil.php?keyword=' + $('#keyword').val(), function(data) {

            $('#container').html(data);
            $('.loader').hide();
        });

    });
});