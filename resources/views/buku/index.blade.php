{{-- @extends('layout.template') --}}
<!-- START DATA -->
{{-- @section('konten') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Halaman Admin</title>
</head>
<div class="my-3 p-3 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <div class="pb-3">
          <form class="d-flex justify-content-center" action="{{url('buku')}}" method="get">
              <input class="form-control me-1 w-50 " type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
              <button class="btn btn-secondary" type="submit">Cari</button>
          </form>
        </div>
        <button class="btn btn-dark"><a href="/logout">logout</a></button>
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
          <a href='{{url('buku/create')}}' class="btn btn-primary">+ Tambah Data</a>
        </div>
  
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-3">NIM</th>
                    <th class="col-md-4">Nama Buku</th>
                    <th class="col-md-4">Gambar</th>
                    <th class="col-md-2">Deskripsi</th>
                    <th class="col-md-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $data->FirstItem() ?>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{$item->nim}}</td>
                    <td>{{$item->namabuku}}</td>
                    <td>
                        <img src="{{ asset($item->image) }}" style="width: 70px; heighxt: 70px;" alt="image">
                    </td>
                    <td>{{$item->deskripsi}}</td>
                    <td>
                        <a href='{{url('buku/'.$item->nim.'/edit')}}' class="btn btn-warning btn-sm">Edit</a>
                        <form onsubmit="return confirm('Yakin dek?')" class="d-inline" action="{{url('buku/'.$item->nim)}}" method="post">
                            @csrf
                            @method('DELETE')
                             <button type="submit" name="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </td>
                </tr>
                <?php $i++?>
                @endforeach
            </tbody>
        </table>
       {{ $data->withQueryString()->links()}}
  </div>
  {{-- @endsection --}}
</body>
</html>
  <!-- AKHIR DATA -->
