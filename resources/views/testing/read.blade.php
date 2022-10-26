{{-- @section('content') --}}

{{-- <div style="margin-left:20%; padding:1px 16px;height:1000px;"> --}}
<br>
<br>
<a href="{{ route('test.add') }}" class="btn btn-success" style="float:left; width: 150px">Tambah Data</a>
<a href="{{ route('test.kosong') }}" class="btn btn-danger" style="margin-left: 20px; width: 150px">Kosongkan Data</a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
    data-bs-target="#exampleModal">Import Data</button>

{{-- <a href="#" class="btn btn-primary" style="margin-left: 20px; width: 150px">Import Data</a> --}}
{{-- <a href="{{ route('test.norm') }}" class="btn btn-warning" style="margin-left: 20px; width: 150px">Normalisasi Data</a> --}}

<button type="button" class="btn btn-warning" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
    data-bs-target="#normModal">Normalisasi Data</button>

<button type="button" class="btn btn-dark" style="margin-left: 20px; width: 150px" data-bs-toggle="modal"
    data-bs-target="#ujiModal">Pengujian Data</button>

<br>
<br>
<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th style="width:1%">No</th>
            <th style="width:24%">Nama</th>
            <th style="width:4%">RAM</th>
            <th style="width:8%">Internal</th>
            <th style="width:10%">Baterai</th>
            <th style="width:9%">Kamera Depan</th>
            <th style="width:9%">Kamera Belakang</th>
            <th style="width:10%">Harga</th>
            <th style="width:10%">Klasifikasi</th>
            <th style="width:12%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($test as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->name }}</td>
                <td>{{ $t->ram }}</td>
                <td>{{ $t->internal }}</td>
                <td>{{ $t->baterai }}</td>
                <td>{{ $t->kam_depan }}</td>
                <td>{{ $t->kam_belakang }}</td>
                <td>{{ $t->harga }}</td>
                <td>
                    @isset($t->kelas)
                        {{ $t->kelas->klas }}
                    @endisset
                </td>
                <td>
                    <a href="{{ route('test.edit', ['id' => $t->id]) }}" class="btn btn-warning btn-xs"><i
                            class='bx bx-edit nav_icon'></i></a>
                    <a href="{{ route('test.delete', ['id' => $t->id]) }}" class="btn btn-danger"><i
                            class='bx bx-trash nav_icon'></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
</div>




<!-- Modal -->
{{-- <form method="post" action="{{ route('test.import') }}" enctype="multipart/form-data"> --}}
{{-- <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
                <input type="submit" class="btn btn-success" value="Import">
            </div>
        </div>
    </div>
</div> --}}
{{-- </form> --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('test.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <button class="btn btn-primary" style="float: right" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<form method="post" action="{{ route('test.norm') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="normModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Normalisasi Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Apakah anda ingin melakukan normalisasi?</label>
                        {{-- <input class="form-control" type="file" id="formFile"> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Normalisasi</button> --}}
                    <input type="submit" class="btn btn-success" value="Normalisasi">
                </div>
            </div>
        </div>
    </div>
</form>

<form method="post" action="{{ route('modal.norm') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="ujiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengujian Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Apakah anda ingin melakukan pengujian data?</label>
                        {{-- <input class="form-control" type="file" id="formFile"> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Normalisasi</button> --}}
                    <input type="submit" class="btn btn-success" value="Uji Data">
                </div>
            </div>
        </div>
    </div>
</form>
{{-- @endsection --}}
