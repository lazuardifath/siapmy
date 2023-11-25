@extends('layouts.main')
@section('title', $user->name)
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/mohithg-switchery/dist/switchery.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
    @endpush


    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>Edit Profil</h5>
                            <span>Kelengkapan profil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img width="90px" height="90px" class="rounded"
                                src="{{ asset('uploads/user-image/' . $user->profile_image) }}" alt="Profile Image">
                            <h4 class="card-title mt-10">{{ $user->name }}</h4>
                            <p class="card-subtitle">
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>
                            <div class="col-md-12 col-lg-12"> <strong>WhatsApp</strong>
                                <br>
                                <p class="text-muted">-</p>
                            </div>
                            <div class="col-md-12 col-lg-12"> <strong>Umur</strong>
                                <br>
                                <p class="text-muted" id="umur"></p>
                            </div>
                            <div class="col-md-12 col-lg-12"> <strong>{{ __('Location') }}</strong>
                                <br>
                                <p class="text-muted">London</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ url('user/update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap<span class="text-red">*</span></label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ clean($user->name, 'titles') }}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}<span class="text-red">*</span></label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ clean($user->email, 'titles') }}" required>
                                        <div class="help-block with-errors"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    @can('edit_password')
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <p class="small">(<span class="text-red">*</span>) Password yang sudah diberikan
                                            tidak perlu diganti dan Cukup dikosongkan saja.</p>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password">
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Profil</label>
                                        <p class="small">Memasukkan foto kamu bersifat (<span class="text-red">*</span>
                                            Opsional)</p>
                                        <input type="file" name="profile_image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">{{ __('Upload') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    @endcan
                                    @cannot('edit_password')
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <p class="small">(<span class="text-red">*</span>) Password yang sudah diberikan
                                            tidak perlu diganti dan Cukup dikosongkan saja.</p>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password" disabled>
                                            <input id="password" type="password"
                                            class="form-control hidden @error('password') is-invalid @enderror" name="password">
                                        <div class="help-block with-errors"></div>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" disabled>
                                            <input id="password-confirm" type="password" class="form-control hidden"
                                            name="password_confirmation">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Foto Profil</label>
                                        <p class="small">Memasukkan foto kamu bersifat (<span class="text-red">*</span>
                                            Opsional)</p>
                                        <input type="file" name="profile_image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                    type="button">{{ __('Upload') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    @endcannot

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-radio">
                                            <label style="margin-left: -24px">Jenis Kelamin<span
                                                    class="text-red">*</span></label>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="jenis_kelamin" id="genderMale"
                                                        value="Laki-laki"
                                                        {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Laki-laki' ? 'checked' : '' }}>
                                                    <i class="helper"></i>Laki-laki
                                                </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <label>
                                                    <input type="radio" name="jenis_kelamin" id="genderFemale"
                                                        value="Perempuan"
                                                        {{ old('jenis_kelamin', $user->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }}>
                                                    <i class="helper"></i>Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir<span class="text-red">*</span></label>
                                        <input class="form-control" type="date" id="tgl_lahir" name="tanggal_lahir"
                                            value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" />
                                    </div>
                                    <div class="form-group">
                                        <label for="kost">Tinggal Dimana<span class="text-red">*</span></label>
                                        <p class="small">Kamu tinggal bersama siapa?</p>
                                        <div class="form-check radio">
                                            <input class="form-check-input" type="radio" name="tinggal_dimana"
                                                id="kost" value="Kost"
                                                {{ old('tinggal_dimana', $user->tinggal_dimana) === 'Kost' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="kost">Kost</label>
                                        </div>
                                        <div class="form-check radio">
                                            <input class="form-check-input" type="radio" name="tinggal_dimana"
                                                id="orangtua" value="Bersama Orangtua"
                                                {{ old('tinggal_dimana', $user->tinggal_dimana) === 'Bersama Orangtua' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="orangtua">Bersama Orangtua</label>
                                        </div>
                                        <div class="form-check radio">
                                            <input class="form-check-input" type="radio" name="tinggal_dimana"
                                                id="lainnya" value="Lainnya"
                                                {{ old('tinggal_dimana', $user->tinggal_dimana) === 'Lainnya' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lainnya">Lainnya</label>
                                            <input type="text" class="form-control mt-2" id="otherTinggalDimana"
                                                name="other_tinggal_dimana"
                                                value="{{ old('other_tinggal_dimana', $user->other_tinggal_dimana) }}"
                                                placeholder="Silahkan isi"
                                                {{ old('other_tinggal_dimana', $user->tinggal_dimana) === 'Lainnya' ? '' : 'disabled' }}>
                                        </div>
                                    </div>
                                    @cannot('edit_settings_role_permit')
                                        <!-- Assign role & view role permisions -->
                                        <div class="form-group">
                                            <label for="role">{{ __('Assign Role') }}<span
                                                    class="text-red">*</span></label>
                                            <p class="small">Tidak bisa edit</p>
                                            {!! Form::select('role', $roles, $user_role->id ?? '', [
                                                'class' => 'form-control select2',
                                                'style' => 'pointer-events: none;',
                                                'placeholder' => 'Select Role',
                                                'id' => 'role',
                                                'required' => 'required',
                                                'disabled' => 'disabled',
                                            ]) !!}
                                            {!! Form::hidden('role', $user_role->id ?? '', ['id' => 'role_hidden']) !!}
                                        </div>
                                    @endcannot

                                    @can('edit_settings_role_permit')
                                        <!-- Assign role & view role permisions -->
                                        <div class="form-group">
                                            <label for="role">{{ __('Assign Role') }}<span
                                                    class="text-red">*</span></label>
                                            {!! Form::select('role', $roles, $user_role->id ?? '', [
                                                'class' => 'form-control select2',
                                                'placeholder' => 'Select Role',
                                                'id' => 'role',
                                                'required' => 'required',
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="role">{{ __('Permissions') }}</label>
                                            <div id="permission" class="form-group">
                                                @foreach ($user->getAllPermissions() as $key => $permission)
                                                    <span class="badge badge-dark m-1">
                                                        <!-- clean unescaped data is to avoid potential XSS risk -->
                                                        {{ clean($permission->name, 'titles') }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <input type="hidden" id="token" name="token"
                                                value="{{ csrf_token() }}">
                                        </div>
                                    @endcan
                                </div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary form-control-right">{{ __('Update') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/form-components.js') }}"></script>
        <script src="{{ asset('plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
        <!--get role wise permissiom ajax script-->
        <script src="{{ asset('js/get-role.js') }}"></script>
        <script>
            // Add an event listener to the radio buttons
            document.querySelectorAll('input[name="tinggal_dimana"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (this.value === 'Lainnya') {
                        document.getElementById('otherTinggalDimana').removeAttribute('disabled');
                    } else {
                        document.getElementById('otherTinggalDimana').setAttribute('disabled', 'disabled');
                    }
                });
            });
        </script>
        <script>
            // Function to calculate age
            function calculateAge(dateString) {
                var dob = new Date(dateString);
                var today = new Date();
                var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                return age;
            }

            // Initial calculation when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                var dob = document.getElementById('tgl_lahir').value;
                var age = calculateAge(dob);
                document.getElementById('umur').textContent = age + ' Tahun';
            });

            // Event listener for changes in date
            document.getElementById('tgl_lahir').addEventListener('change', function() {
                var dob = this.value;
                var age = calculateAge(dob);
                document.getElementById('umur').textContent = age + ' Tahun';
            });
        </script>
    @endpush
@endsection
