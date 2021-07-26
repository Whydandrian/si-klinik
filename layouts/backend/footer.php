<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<?php
$page = basename($_SERVER['PHP_SELF']);
if ($page === "pendaftaran_pasien.php") {
    include 'pendaftaran.php';
}
if ($page === "resep_pasien.php") {
    include 'biaya_obat.php';
}
?>

<script>
    function restrictAlphabets(e) {
        var x = e.which || e.keycode;
        if ((x >= 48 && x <= 57))
            return true;
        else
            return false;
    }
    $(document).ready(function() {
        $('#nama_pasien').focus();
        let data = 0;
        $('#data-pasien-lama').hide();
        // $("#harga_total").val(parseInt(data));
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        $("#jumlah").keyup(function() {
            var loan_amt = document.getElementById('harga_obat');
            loan_amt.value = loan_amt.value.replace(/[^0-9]/g, '');

            var jumlah = $("#jumlah").val();

            var total = parseInt(loan_amt.value) * parseInt(jumlah);
            $("#harga_total").val(total);
        });

        $('#example').DataTable();

        $('input[type=radio][name=pegawai_pilihan]').change(function() {
            if (this.value == 1) {
                $('#data-pasien-lama').show();
                $('#data-pasien-baru').hide();
            } else if (this.value == 2) {
                $('#data-pasien-baru').show();
                $('#data-pasien-lama').hide();
            }
        });

        $(".tombol-simpan").click(function() {
            // Property data pasien dan pendaftaran
            var nama_pasien = $('#nama_pasien').val();
            var nik_ktp = $('#nik_ktp').val();
            var golongan_darah = $('#golongan_darah').val();
            var jenis_kelamin = $('#jenis_kelamin').val();
            var jenis_pasien = $('#jenis_pasien').val();
            var telepon = $('#telepon').val();
            var alamat_pasien = $('#alamat_pasien').val();

            var kode_pasien = $('#kd_pasien').val();
            var kode_poli = $('#kode_poli').val();
            var kode_layanan = $('#kode_layanan').val();
            var keluhan = $('#keluhan').val();

            // Cek apakah data pasien lama atau pasien baru
            if ($("#cek_pegawai_baru").is(":checked")) {
                // && kode_poli != "" && kode_layanan != "" && keluhan != ""
                if (nama_pasien != "" && nik_ktp != "" && golongan_darah != "" && jenis_kelamin != "" && jenis_pasien != "" && telepon != "" && alamat_pasien != "" && kode_poli != "" && kode_layanan != "" && keluhan != "") {
                    var data = $('.form-user').serialize();
                    $.ajax({
                        type: 'POST',
                        url: "proses_tambah.php",
                        data: data,
                        cache: false,
                        success: function() {
                            setTimeout(function() {
                                Swal.fire(
                                    'INFORMASI ADMIN',
                                    'Data Pasien Berhasil ditambahkan!',
                                    'success'
                                );
                                document.location.reload();
                            }, 1200);
                        }
                    });

                } else {
                    Swal.fire(
                        'INFORMASI ADMIN',
                        'Mohon periksa data registrasi pasien kembali!',
                        'error'
                    )
                }
            } else if ($("#cek_pegawai_lama").is(":checked")) {
                if (kode_pasien != "" && kode_poli != "" && kode_layanan != "" && keluhan != "") {
                    var data = $('.form-user').serialize();
                    $.ajax({
                        type: 'POST',
                        url: "tambah_pendaftaran.php",
                        data: data,
                        cache: false,
                        success: function() {
                            setTimeout(function() {
                                Swal.fire(
                                    'INFORMASI ADMIN',
                                    'Data Pasien Berhasil ditambahkan!',
                                    'success'
                                );
                                document.location.reload();
                            }, 1200);
                        }
                    });
                } else {
                    Swal.fire(
                        'INFORMASI ADMIN',
                        'Mohon periksa data registrasi pasien kembali!',
                        'error'
                    )
                }
            }
        });

    });

    // const selectElement = document.querySelector('.harga_total');
    // selectElement.addEventListener('change', (event) => {
    //     // const result = document.querySelector('.result');
    //     // result.textContent = `You like ${event.target.value}`;
    //     console.log('test event onchange');
    // });
</script>
<?php
$page = basename($_SERVER['PHP_SELF']);
if ($page === "dashboard.php") {
    include 'dash.php';
}
?>
<!-- Optional JavaScript; choose one of the two! -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>