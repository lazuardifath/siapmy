@extends('layouts.main')
@section('title', 'Start CBT')
@section('content')
    @push('head')
    @endpush

    <div class="container-fluid">
        <form action="{{ route('start-cbt.store') }}" method="POST">
            @csrf
        <div class="row">
            <div class="col-xl-8 col-md-6">
                <div class="card">
                    <div class="card-header d-block text-nowrap">
                        <h3>Pengajuan Sesi CBT</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body px-4 table-border-style">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1>Ajukan Sesi CBT</h1>
                                        <div class="mb-3">
                                            <label for="keluhan" class="form-label">Keluhan</label>
                                            <textarea class="form-control html-editor" id="keluhan" name="keluhan" rows="10"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" class="form-control" id="status" name="status">
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card new-cust-card">
                    <div class="card-header">
                        <h3>Action</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="ik ik-chevron-left action-toggle"></i></li>
                                <li><i class="ik ik-minus minimize-card"></i></li>
                                <li><i class="ik ik-x close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-default">Cancel</button>
                          </div>
                    </div>


                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('js/form-advanced.js') }}"></script>
    @endpush
@endsection
