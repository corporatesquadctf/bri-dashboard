<!-- <h1>Tambah Gambar</h1><hr>
<div style="color: red;"><?php echo (isset($message))? $message : ""; ?></div>
<?php echo form_open("gambar/tambah", array('enctype'=>'multipart/form-data')); ?>
  <table cellpadding="8">
    <tr>
      <td>Deskripsi</td>
      <td><input type="hidden" name="TITLE" value="valval"></td>
      <td><input type="hidden" name="VCIF" value="XYZ"></td>
    </tr>
    <tr>
      <td>Gambar</td>
      <td><input type="file" name="input_gambar"></td>
    </tr>
  </table>
    
  <hr>
  <input type="submit" name="submit" value="Simpan">
  <a href="<?php echo base_url(); ?>"><input type="button" value="Batal"></a>
<?php echo form_close(); ?> -->