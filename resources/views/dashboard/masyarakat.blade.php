<a href="{{ route('create.pengaduan') }}" class="btn btn-primary btn-sm">Buat Laporan</a>
<hr>
<table class="table text-center">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Laporan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['pengaduan'] as $key => $pengaduan)
            <tr>
                <td scope="row">{{ $key + 1 }}</td>
                <td>{{ $pengaduan->tanggal}}</td>
                <td>
                    @if ($pengaduan->status == 'dikirim')
                        <span class="badge bg-danger">Belum Ditanggapi</span>
                    @elseif($pengaduan->status == 'proses')
                        <span class="badge bg-warning">Proses</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                </td>
                <td>
                    @if ($pengaduan->status == 'dikirim')
                        <a href="{{ route('edit.pengaduan', $pengaduan->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#delete-{{ $pengaduan->id }}">
                            Batalkan
                        </button>
                    @else
                    @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#detail-{{ $pengaduan->id }}">
                        Detail
                    </button>
                </td>
            </tr>
            <!-- Modal detail -->
            <div class="modal fade" id="detail-{{ $pengaduan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title">Detail Pengaduan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Isi Laporan</p>
                                </div>
                                <div class="col-md-6">
                                    @if (isset($pengaduan->tanggapan->user->name))
                                        <p class="font-weight-bold">Ditanggapi Oleh : {{$pengaduan->tanggapan->user->name}}</p>
                                    @else
                                        <p class="font-weight-bold">Ditanggapi Oleh : -</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>{{ $pengaduan->isi_laporan }}</p>
                                </div>
                                <div class="col-md-6">
                                    @if (isset($pengaduan->tanggapan->tanggal))
                                        <p class="font-weight-bold">Pada Tanggal : {{$pengaduan->tanggapan->tanggal}}</p>
                                    @else
                                        <p class="font-weight-bold">Pada Tanggal : -</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Tanggapan</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="font-weight-bold">Foto</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if (isset($pengaduan->tanggapan->isi_tanggapan))
                                        <p>{{$pengaduan->tanggapan->isi_tanggapan}}</p>
                                    @else
                                        <p>Tidak Ada Tanggapan</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if (isset($pengaduan->foto))
                                        <img class="img-fluid" style="height: 50vh;width:auto;" src="{{ asset($pengaduan->foto) }}" alt="">
                                    @else
                                        <p>Foto Tidak Ada</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Delete -->
            <div class="modal fade" id="delete-{{ $pengaduan->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Batalkan Pengaduan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="display-6">Batalkan Pengaduan Ini</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <form action="{{ route('destroy.pengaduan', $pengaduan->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Batalkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </tbody>
</table>
