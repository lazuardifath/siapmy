@extends('layouts.main')
@section('title', 'Start CBT')
@section('content')
    @push('head')
    @endpush

    <div class="container-fluid">
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

                                    <form action="{{ route('start-cbt.update', $sesi->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="keluhan" class="form-label">Keluhan</label>
                                            <textarea class="form-control html-editor" id="summernote" name="keluhan" rows="14">{{ $sesi->keluhan }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <input type="text" class="form-control" id="status" name="status" value="{{ $sesi->status }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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

                </form>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.repeater/jquery.repeater.min.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <script src="{{ asset('js/form-advanced.js') }}"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    @endpush
@endsection
