<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="../../assets/js/jquery.dataTables.min.js"></script>
<script src="../../assets/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(nim) {
        document.getElementById('psn_nama').value = dtMhs[nim].nama_pasien;
        document.getElementById('psn_kode').value = dtMhs[nim].kode_pasien;
        document.getElementById('almt').value = dtMhs[nim].alamat;
    };

    function sweetAlert() {
        Swal.fire(
            'Informasi Pendaftaran',
            'Berhasil Registrasi Pasien!',
            'success'
        )
    }
</script>
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
        $("#harga_total").val(parseInt(data));

        $("#harga_obat").keyup(function() {
            var hargaObat = $("#harga_obat").val();
            var jumlah = $("#jumlah").val();

            var total = parseInt(hargaObat) * parseInt(jumlah);
            $("#harga_total").val(total);

        });

        $('body').on("change", "#id_obat", function() {
            var harga = $("#harga").val();
            var jumlah = $("#jumlah").val();
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
            let nama_pasien = $('#nama_pasien').val();
            let nik_ktp = $('#nik_ktp').val();
            let golongan_darah = $('#golongan_darah').val();
            let jenis_kelamin = $('#jenis_kelamin').val();
            let jenis_pasien = $('#jenis_pasien').val();
            let telepon = $('#telepon').val();
            let alamat_pasien = $('#alamat_pasien').val();

            if (nama_pasien != "" && nik_ktp != "" && golongan_darah != "" && jenis_kelamin != "" && jenis_pasien != "" && telepon != "" && alamat_pasien != "") {
                $.ajax({
                type: 'POST',
                url: "proses_tambah.php",
                data: {
					nama_pasien: nama_pasien,
					nik_ktp: nik_ktp,
					phone: phone,
					city: city				
				},
				cache: false,
                success: function() {
                    
                    Swal.fire(
                        'Informasi Pendaftaran',
                        'Berhasil Registrasi Pasien!',
                        'success'
                    )

                }
            });

            } else {
                Swal.fire(
                    'Validasi Input Data',
                    'Input data anda salah. Mohon periksa kembali!',
                    'error'
                )
            }
            // var data = $('.form-user').serialize();
            
        });

    });

    const selectElement = document.querySelector('.harga_total');
    selectElement.addEventListener('change', (event) => {
        // const result = document.querySelector('.result');
        // result.textContent = `You like ${event.target.value}`;
        console.log('test event onchange');
    });
</script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
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