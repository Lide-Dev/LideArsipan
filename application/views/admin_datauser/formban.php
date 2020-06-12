<div class="form-group">
    <div class="container text-center">
        <i class="fas fa-exclamation-triangle fa-6x text-warning"></i>
        <p class='my-3'>Akun ini akan dibanned. Apa anda yakin? Anda bisa mengembalikannya di blacklist mode</p>
        <div class="form-group">
          <label for="ad_finishban">Tenggat Waktu</label>
          <select class="form-control" name="date" id="ad_finishban">
            <option value="1">1 Minggu</option>
            <option value="2">1 Bulan</option>
            <option value="3">6 Bulan</option>
            <option value="4">1 Tahun</option>
            <option value="5">10 Tahun</option>
          </select>
        </div>
        <div class="form-group">
          <label for="ad_descban">Alasan Ban</label>
          <input type="text"
            class="form-control" name="desc" id="ad_descban" aria-describedby="helpId" placeholder="">
          <small id="helpId" class="form-text text-muted">Alasan diperlukan karena ini akan memberitahu User bahwa apa yang salah karena ban ini.</small>
        </div>
    </div>
</div>