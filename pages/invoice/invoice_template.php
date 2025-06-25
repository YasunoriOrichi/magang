<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Invoice <?= $invoice_no ?></title>
  <style>
    .logo-img {
      width: 120px;
      height: 120px;
      object-fit: contain;
    }
    .signature-img {
      width: 180px;
      height: 180px;
      object-fit: contain;
    }
    .line {
      border: none;
      height: 2px;
      background-color: black;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      font-family: Arial, sans-serif;
    }
    table, th, td {
      padding: 8px;
    }
    th {
      background-color: #f2f2f2;
    }
    label {
      display: inline-block;
      margin: 3px 0;
    }
    .tabel-item {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <table width="100%" style="border-collapse: collapse;">
    <tr>
      <td style="width: 50%; vertical-align: top;"><img src="<?= BASE_PATH . $company['COMPANY_LOGO'] ?>" class="logo-img" alt="Logo"></td>
      <td align="right" style="width: 50%; vertical-align: top;">
        <label>Referensi: <?= $invoice_no ?></label><br>
        <label>Tanggal: <?= $invoice_date ?></label>
      </td style="width: 50%; vertical-align: top;">
    </tr>
  </table>

  <table width="100%" style="border-collapse: collapse; margin-top: 20px;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <label><b>Info Perusahaan</b></label><br>
      <hr class="line">
      <label><?= strtoupper($company['COMPANY_NAME']) ?></label><br>
      <label>Alamat: <?= $company['COMPANY_ADDRESS'] ?></label><br>
      <label>Telp: <?= $company['COMPANY_PHONE'] ?></label><br>
      <label>Email: <?= $company['COMPANY_EMAIL'] ?></label>
    </td>
    <td style="width: 50%; vertical-align: top;">
      <label><b>Tagihan Untuk</b></label><br>
      <hr class="line">
      <label><?= strtoupper($customer) ?></label><br>
      <label>Telp: <?= $client['NUMBER'] ?></label><br>
      <label>Email: <?= $client['EMAIL'] ?></label>
    </td>
  </tr>
</table>

  <br>

  <table class="tabel-item">
    <thead class="tabel-item">
      <tr class="tabel-item">
        <th class="tabel-item">No</th>
        <th class="tabel-item">Nama Item</th>
        <th class="tabel-item">Jumlah</th>
        <th class="tabel-item">Harga Satuan</th>
        <th class="tabel-item">Total</th>
      </tr>
    </thead>
    <tbody class="tabel-item">
      <?php $no = 1;
      foreach ($details as $item): ?>
        <tr class="tabel-item">
          <td class="tabel-item"><?= $no++ ?></td>
          <td class="tabel-item"><?= $item['NAME'] ?></td>
          <td class="tabel-item"><?= $item['QTY'] ?></td>
          <td class="tabel-item">Rp<?= number_format($item['UNIT_PRICE'], 0, ',', '.') ?></td>
          <td class="tabel-item">Rp<?= number_format($item['TOTAL_PRICE'], 0, ',', '.') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <br>

  <table width="100%" style="border-collapse: collapse;">
    <tr>
      <td width="70%"></td>
      <td>
        <label>Total: Rp<?= number_format($total, 0, ',', '.') ?></label><br>
        <label>Dibayar: Rp<?= number_format($payment['PAYMENT'], 0, ',', '.') ?></label><br>
        <label>Sisa Tagihan: Rp<?= number_format($total - $payment['PAYMENT'], 0, ',', '.') ?></label>
      </td>
    </tr>
  </table>

  <br><br><br>

  <table width="100%">
    <tr>
      <td style="width: 50%;">
        <label><b>KETERANGAN:</b></label>
        <hr class="line">
        <p><?= $note ?></p>

        <br><br>

        <label><b>SYARAT & KETENTUAN:</b></label>
        <hr class="line">
        <p>
            1. Barang tidak dapat dikembalikan kecuali cacat produksi.<br>
            2. Mohon konfirmasi pembayaran ke admin sesuai nomor di atas.
        </p>
      </td>
      <td align="center">
        <p><strong><?= $invoice_date ?></strong></p>
        <img class="signature-img" src="<?= BASE_PATH . $company['COMPANY_SIGNATURE'] ?>" alt="Tanda Tangan"><br>
        <strong>Nevil Nurseri</strong>
      </td>
    </tr>
  </table>
</body>
</html>