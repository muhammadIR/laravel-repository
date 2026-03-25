<!DOCTYPE html>
<html>
<head>
<title>Dashboard Finance</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
background:#f4f6f9;
}

.card-dashboard{
color:white;
}

</style>

</head>
<body>

<div class="container mt-4">

<h3>Dashboard Finance</h3>

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

<div class="card">
<div class="card-header">
Tambah Transaksi
</div>

<div class="card-body">

<form action="/finance" method="POST">
@csrf

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

<button class="btn btn-success">Simpan</button>

</form>

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
</tr>

@foreach($data as $d)

<tr>
<td>{{ $d->keterangan }}</td>
<td>Rp {{ number_format($d->pemasukan) }}</td>
<td>Rp {{ number_format($d->pengeluaran) }}</td>
</tr>

@endforeach

</table>

</div>
</div>

</div>

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