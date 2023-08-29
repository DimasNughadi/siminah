<div class="radio-wrapper d-flex">
    <div class="left-side">
        <input type="radio" name="isKecamatanOrKelurahan" id="isKecamatanTrue" value="1" selected>
        <label for="isKecamatanTrue">Kecamatan</label>
    </div>
    <div class="right-side">
        <input type="radio" name="isKecamatanOrKelurahan" id="isKecamatanFalse" value="0">
        <label for="isKecamatanFalse">Kelurahan</label>
    </div>
</div>


<script>
    const defaultChecked = document.querySelector('#isKecamatanTrue');
    defaultChecked.checked = true;
</script>