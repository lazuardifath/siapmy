@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-title">Halo, <b>{{ $data }}</b></h3>
                        <div class="widget-tools pull-right">
                            <button type="button" class="btn btn-widget-tool minimize-widget ik ik-plus"></button>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="widget bg-teal">
                                    <div class="widget-header">
                                        <h3 class="widget-title"><b>Introduction</b></h3>
                                    </div>
                                    <div class="widget-body">
                                        <p class="card-text text-break"><i><b>Self Injury Awareness Program</b></i>
                                            bertujuan untuk
                                            mendidik dan mendukung individu terkait perilaku menyakiti diri. Melalui
                                            kegiatan
                                            edukatif, diskusi terbuka, dan sumber daya yang bermanfaat, program ini
                                            bertujuan
                                            menghilangkan stigma seputar kesehatan mental. Dengan kolaborasi masyarakat,
                                            kami
                                            berharap dapat memberikan bantuan kesehatan mental kepada mereka yang
                                            memerlukan.
                                        </p>
                                        <div class="m-2 p-2 text-center">
                                            <button type="button" class="btn btn-danger m-1" data-toggle="modal"
                                                data-target="#exampleModalCenter"><i class="ik ik-info"></i>Detail
                                                Informasi</button>
                                            <button type="button" class="btn btn-warning m-1" data-toggle="modal"
                                                data-target="#fullwindowModal"><i class="ik ik-info"></i>Layanan
                                                Konseling</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-md-12">
                                <div class="card comp-card border border-light-subtle bg-warning-subtle">
                                    <div class="card-body">
                                        <div class="row align-items-center m-2">
                                            <div class="col">
                                                <h6 class="mb-4"><b>Cognitive Behavioural Therapy (CBT)</b></h6>
                                                <p>Cognitive behaviour therapy merupakan psikoterapi jangka pendek, yang
                                                    menjadi
                                                    dasar berfikir, berperasaan dan bertingkah laku dalam setiap interaksi
                                                    menyelesaikan masalah klien.</p>
                                                <a href="/start-cbt" type="button" class="btn btn-danger m-1"><i
                                                        class="ik ik-play-circle"></i>Start CBT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <div class="card comp-card border border-light-subtle bg-warning-subtle">
                                    <div class="card-body">
                                        <div class="row align-items-center m-2">
                                            <div class="col">
                                                <h6 class="mb-4"><b>Ruang Diskusi Mental</b></h6>
                                                <p>Cognitive behaviour therapy merupakan psikoterapi jangka pendek, yang
                                                    menjadi
                                                    dasar berfikir, berperasaan dan bertingkah laku dalam setiap interaksi
                                                    menyelesaikan masalah klien.</p>
                                                <a type="button" href="" class="btn btn-warning p-1 m-1 disabled readonly"><i
                                                        class="ik ik-play-circle"></i>Masuk Ruang Obrolan</a> <span class="font-italic">Coming Soon!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('manage_patient_book')
                            <div class="col-xl-4 col-md-12">
                                <div class="card comp-card border border-light-subtle bg-warning-subtle">
                                    <div class="card-body">
                                        <div class="row align-items-center m-2">
                                            <div class="col">
                                                <h6 class="mb-4"><b>Buku Kerja Pasien</b></h6>
                                                <p>Alat atau sumber daya yang digunakan dalam bidang kesehatan mental untuk membantu individu yang menderita masalah harga diri rendah.</p>
                                                <button type="button" class="btn btn-info m-1"><i
                                                        class="ik ik-play-circle"></i>Lihat Buku Kerja</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterLabel">MySiap Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Program Kesadaran Terhadap Cedera Diri:</b> Membangun Pemahaman dan Dukungan

                        Program Kesadaran Terhadap Cedera Diri adalah inisiatif yang berfokus pada kesehatan mental,
                        khususnya perilaku menyakiti diri sendiri. Tujuan utamanya adalah meningkatkan pemahaman masyarakat
                        tentang masalah ini, serta memberikan dukungan yang diperlukan bagi individu yang mungkin
                        terpengaruh.<br>

                        Melalui kegiatan pendidikan dan kesadaran, program ini menyediakan informasi mendalam tentang
                        perilaku menyakiti diri dan kesehatan mental secara umum. Materi edukatif, diskusi terbuka, dan
                        sumber daya bermanfaat disediakan untuk membantu individu memahami, mencegah, dan mengatasi perilaku
                        tersebut.<br>

                        Salah satu aspek penting dari program ini adalah menghilangkan stigma seputar masalah kesehatan
                        mental. Dengan mempromosikan dialog terbuka dan pengertian, kami berharap individu akan merasa lebih
                        nyaman untuk mencari bantuan dan dukungan.<br>

                        Dengan kolaborasi dan partisipasi aktif dari masyarakat, Program Kesadaran Terhadap Cedera Diri
                        dapat menjadi sebuah langkah positif menuju pemahaman yang lebih baik tentang kesehatan mental dan
                        menyediakan bantuan bagi mereka yang membutuhkannya.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- push external js -->
    @push('script')
    @endpush
@endsection
