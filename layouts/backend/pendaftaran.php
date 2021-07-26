<script type="text/javascript">
  <?php
  echo $jsArray;
  ?>
  function changeValue(nim) {
    document.getElementById('psn_nama').value = dtMhs[nim].nama_pasien;
    document.getElementById('psn_kode').value = dtMhs[nim].kode_pasien;
    document.getElementById('almt').value = dtMhs[nim].alamat;
    document.getElementById('tlp').value = dtMhs[nim].telepon;
    if (dtMhs[nim].jenis_kelamin == "L") {
      document.getElementById('jns_kelamin').value = "Laki-laki";
    } else {
      document.getElementById('jns_kelamin').value = "Perempuan";
    }
  };
</script>