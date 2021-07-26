<script type="text/javascript">
    <?php
    echo $jsArray;
    echo $jsArrayObat;
    ?>



    function changeValue(nim) {
        document.getElementById('tagihan_layanan').value = dtMhs[nim].nama_pasien;
        document.getElementById('total_tagihan_layanan').value = formatRupiah(dtMhs[nim].tagihan_layanan, 'Rp. ');
        document.getElementById('nama_layanan').value = dtMhs[nim].nama_layanan;
        document.getElementById('alamat_pasien').value = dtMhs[nim].alamat;
    };

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
    <?= $jsArrayObat; ?>

    function obatValue(nim) {
        document.getElementById('harga_obat').value = formatRupiah(dtMhs[nim].harga_obat, 'Rp. ');
    };
</script>