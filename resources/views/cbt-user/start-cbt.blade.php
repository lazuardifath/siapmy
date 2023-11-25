@extends('layouts.main')
@section('title', 'Start CBT')
@section('content')
    @push('head')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .badge-disabled {
                pointer-events: none;
                opacity: 0.6;
            }
        </style>
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-md-6">
                <div class="card">
                    <div class="card-header d-block text-nowrap">
                        <h3>Aktivitas CBT</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                        <a href="{{ route('start-cbt.create') }}" class="btn btn-primary me-md-1 mt-4 mx-4 text-white"
                            type="button"><i class="ik ik-external-link text-white"></i>Ajukan Sesi</a>
                    </div>
                    <div class="card-body px-4 table-border-style">
                        <div class="table-responsive">
                            <table id="cbt_table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Sesi</th>
                                        <th>Keluhan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($sesis->count() == 0)
                                        <tr>
                                            <td colspan="4">Tidak ada sesi yang diajukan</td>
                                        </tr>
                                    @else
                                        @foreach ($sesis as $sesi)
                                            <tr>
                                                <td scope="row">#{{ $sesi->uid }}</td>
                                                <td class="text-truncate" style="max-width: 170px;">{{ $sesi->keluhan }}
                                                </td>
                                                <td>{{ $sesi->status }}</td>
                                                <td>

                                                    <div class="btn-group" role="group" aria-label="Action">
                                                        <a href="{{ route('start-cbt.edit', $sesi->id) }}"
                                                            class="btn btn-warning text-white" type="button">
                                                            <i class="ik ik-edit text-white"></i>
                                                        </a>
                                                        <a href="{{ route('start-cbt.show', $sesi->id) }}"
                                                            class="btn btn-info me-md-1 text-white" type="button">
                                                            <i class="ik ik-eye text-white"></i>
                                                        </a>
                                                        <a href="{{ url('start-cbt/delete/' . $sesi->id) }}"
                                                            class="delete-link btn btn-danger">
                                                            <i class="ik ik-trash-2 text-white"></i>
                                                        </a>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header d-block">
                        <h3 class="m-2">CBT Terakhir</h3><span><strong><a href="#" class="badge badge-dark mb-1">ID
                                    Sesi : #132424</a></strong></span>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="align-middle mb-25">
                            <div class="d-flex align-items-center">
                                <i class="ik ik-check-circle ik-2x mr-3 text-success"></i>
                                <div>
                                    <a href="#!">
                                        <h6><b>Sesi</b><b class="text-success"> Pertama</b></h6>
                                    </a>
                                    <p class="text-muted mb-0 d-inline-block text-truncate text-small"
                                        style="max-width: 150px;">
                                        Pengkajian</p>
                                    <span class="status"><a href="#" class="badge badge-dark mb-1"><i
                                                class="ik ik-feather"></i> Masuk
                                            Sesi</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-flex align-items-center">
                                <i class="ik ik-x-circle ik-2x mr-3 text-danger"></i>
                                <div>
                                    <a href="#!">
                                        <h6><b>Sesi</b><b class="text-danger"> Kedua</b></h6>
                                    </a>
                                    <p class="text-muted mb-0 d-inline-block text-truncate text-small"
                                        style="max-width: 150px;">
                                        Terapi kognitif</p>
                                    <span class="status"><a href="#" class="badge badge-danger mb-1 badge-disabled"><i
                                                class="ik ik-feather"></i> Masuk Sesi</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-flex align-items-center">
                                <i class="ik ik-x-circle ik-2x mr-3 text-danger"></i>
                                <div>
                                    <a href="#!">
                                        <h6><b>Sesi</b><b class="text-danger"> Ketiga</b></h6>
                                    </a>
                                    <p class="text-muted mb-0 d-inline-block text-truncate text-small"
                                        style="max-width: 150px;">
                                        Terapi Perilaku</p>
                                    <span class="status"><a href="#" class="badge badge-danger mb-1 badge-disabled"><i
                                                class="ik ik-feather"></i> Masuk Sesi</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-flex align-items-center">
                                <i class="ik ik-x-circle ik-2x mr-3 text-danger"></i>
                                <div>
                                    <a href="#!">
                                        <h6><b>Sesi</b><b class="text-danger"> Keempat</b></h6>
                                    </a>
                                    <p class="text-muted mb-0 d-inline-block text-truncate text-small"
                                        style="max-width: 150px;">
                                        Evaluasi Terapi Kognitif dan Terapi Perilaku</p>
                                    <span class="status"><a href="#" class="badge badge-danger mb-1 badge-disabled"><i
                                                class="ik ik-feather"></i> Masuk Sesi</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="align-middle mb-25">
                            <div class="d-flex align-items-center">
                                <i class="ik ik-x-circle ik-2x mr-3 text-danger"></i>
                                <div>
                                    <a href="#!">
                                        <h6><b>Sesi</b><b class="text-danger"> Kelima</b></h6>
                                    </a>
                                    <p class="text-muted mb-0 d-inline-block text-truncate text-small"
                                        style="max-width: 150px;">
                                        Pencegahan Kekambuhan</p>
                                    <span class="status"><a href="#"
                                            class="badge badge-danger mb-1 badge-disabled"><i class="ik ik-feather"></i>
                                            Masuk Sesi</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script>
            $(document).ready(function() {

                $(document).on('click', '#cbt_table .delete-link', function(event) {
                    event.preventDefault();

                    const deleteLink = event.currentTarget;
                    const url = deleteLink.getAttribute('href');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    })
                });

            });
        </script>
    @endpush
@endsection
