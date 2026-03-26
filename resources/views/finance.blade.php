<!DOCTYPE html>
<html>
<head>
<title>Dashboard Finance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    background:#f4f6f9;
}
.card-dashboard {
    color:white;
}
</style>
</head>
<body>

<div class="container mt-4">

<!-- Header dengan Logout -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Dashboard Finance</h3>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>

<div class="row">

<div class="col-md-4">
<div class="card bg-success card-dashboard">
<div class="card-body">
<h5>Total Pemasukan</h5>
<h3>Rp {{ number_format($pemasukan) }}</h3>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card bg-danger card-dashboard">
<div class="card-body">
<h5>Total Pengeluaran</h5>
<h3>Rp {{ number_format($pengeluaran) }}</h3>
</div>
</div>
</div>

<div class="col-md-4">
<div class="card bg-primary card-dashboard">
<div class="card-body">
<h5>Saldo</h5>
<h3>Rp {{ number_format($saldo) }}</h3>
</div>
</div>
</div>

</div>

<div class="row mt-4">

<div class="col-md-6">

<!-- Tombol Tambah Transaksi -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
  Tambah Transaksi
</button>

<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="/finance" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Transaksi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>

            <div class="mb-3">
                <label>Pemasukan</label>
                <input type="number" name="pemasukan" class="form-control">
            </div>

            <div class="mb-3">
                <label>Pengeluaran</label>
                <input type="number" name="pengeluaran" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

</div>

<div class="col-md-6">

<div class="card">
<div class="card-header">
Grafik Keuangan
</div>

<div class="card-body">
<canvas id="financeChart"></canvas>
</div>
</div>

</div>

</div>

<div class="card mt-4">

<div class="card-header">
Data Finance
</div>

<div class="card-body">

<table class="table table-bordered">
<tr>
<th>Keterangan</th>
<th>Pemasukan</th>
<th>Pengeluaran</th>
<th>Aksi</th>
</tr>

@foreach($data as $d)
<tr>
<td>{{ $d->keterangan }}</td>
<td>Rp {{ number_format($d->pemasukan) }}</td>
<td>Rp {{ number_format($d->pengeluaran) }}</td>
<td>
  <!-- Tombol Ubah -->
  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubahModal{{ $d->id }}">
    Ubah
  </button>

  <!-- Modal Ubah -->
  <div class="modal fade" id="ubahModal{{ $d->id }}" tabindex="-1" aria-labelledby="ubahModalLabel{{ $d->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/finance/{{ $d->id }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="ubahModalLabel{{ $d->id }}">Ubah Transaksi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control" value="{{ $d->keterangan }}">
            </div>
            <div class="mb-3">
              <label>Pemasukan</label>
              <input type="number" name="pemasukan" class="form-control" value="{{ $d->pemasukan }}">
            </div>
            <div class="mb-3">
              <label>Pengeluaran</label>
              <input type="number" name="pengeluaran" class="form-control" value="{{ $d->pengeluaran }}">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Tombol Hapus -->
  <form action="/finance/{{ $d->id }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data?')">Hapus</button>
  </form>
</td>
</tr>
@endforeach
</table>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const ctx = document.getElementById('financeChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pemasukan','Pengeluaran'],
        datasets: [{
            label: 'Finance',
            data: [{{ $pemasukan }}, {{ $pengeluaran }}]
        }]
    }
});
</script>

</body>
</html>