<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}" type="image/x-icon">
    <title>SMA Plus PGRI Cibinong</title>
    <link rel="stylesheet" href="{{asset('coreui/css/coreui.min.css')}}">
    <link rel="stylesheet" href="{{asset('coreui-icons/css/all.min.css')}}">
    <style>
    .header-pesat {
        text-decoration: none;
    }
    .header-img-pesat {    
        margin-top: -10px;
    }
    .header-txt-pesat {
        display: contents;
        font-weight: bold;
        font-size: 30px;
        color: #777a7a;
    }
    .header-time-pesat {
        font-weight: bold;
    }
    .header-title-pesat {
        font-weight: bold;
    }

    .spin {
        display: none;
        position: fixed;
        height: 4rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .show {
        display: block;
    }

    @media only screen and (max-width: 600px) {
        .header-pesat {
            margin-top: 10px;
        }
        .header-txt-pesat {
            display: contents;
            font-weight: bold;
            font-size: 28px;
            color: #777a7a;
        }
        .footer {
            display: block;
        }
        .footer-item {
            text-align: center;
        }
    }
    </style>
</head>
<body>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            {{-- <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <i class="icon icon-lg cil-menu"></i>
            </button> --}}
            <a href="https://smapluspgri.sch.id/" class="me-md-3 header-pesat">
                <img class="header-img-pesat" src="{{asset('images/favicon.png')}}" alt="SMA Plus PGRI Cibinong" height="46">
                <div class="header-txt-pesat">
                    SMA Plus PGRI Cibinong
                </div>
            </a>
            <div class="header-nav ms-auto header-time-pesat">
                {{$tgl}}&nbsp;&nbsp;<span id="span"></span>
            </div>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
            <div class="header-title-pesat">BUKU TAMU</div>
        </div>
    </header>
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @include('flash-message')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <form action="" method="POST" class="needs-validation" id="bukutamu-form" novalidate>
                            @csrf
                                <div class="row align-items-center">
                                    <div class="col-sm-6 mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="Silahkan Masukan Nama Anda" required>
                                        <div class="invalid-feedback">Nama Wajib Diisi!</div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value='L' required>
                                            <label class="form-check-label">
                                                Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value='P'>
                                            <label class="form-check-label">
                                                Perempuan
                                            </label>
                                            <div class="invalid-feedback">Jenis Kelamin Wajib Diisi!</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-8 mb-3">
                                        <input type="number" name="hp" class="form-control" placeholder="Silahkan Masukan No HP Anda" maxlength="30" required>
                                        <div class="invalid-feedback">No HP Wajib Diisi!</div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-12 mb-3">
                                        <input type="text" name="agency" class="form-control" placeholder="Silahkan Masukan Nama Instansi Anda" required>
                                        <div class="invalid-feedback">Nama Instansi Wajib Diisi!</div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-12 mb-3">
                                        <textarea class="form-control" name="necessary" rows="3" placeholder="Silahkan Ketikan Keperluan Anda" required></textarea>
                                        <div class="invalid-feedback">Keperluan Wajib Diisi!</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <button type="submit" class="btn btn-secondary" onclick="resetForm()">Reset</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                            <img src="{{asset('images/load.gif')}}" id="spinner" class="spin hide">
                        </div>
                        <div class="col-sm-6">
                            <table class="table caption-top">
                                <caption>Riwayat Catatan Buku Tamu</caption>
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Instansi</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                    <tr>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->agency}}</td>
                                        <td>{{date('d/m/Y', strtotime($d->created_at))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-item"><a href="https://smapluspgri.sch.id">RPL</a> © 2022 Departemen IT.</div>
        <div class="ms-auto footer-item">Powered by&nbsp;<a href="https://smapluspgri.sch.id">PESAT</a></div>
    </footer>
</div>
<script src="{{asset('coreui/js/coreui.bundle.min.js')}}"></script>
<script>
var span = document.getElementById('span');
function time() {
  var d = new Date();
  var s = d.getSeconds();
  var m = d.getMinutes();
  var h = d.getHours();
  span.textContent = 
    ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
}
setInterval(time, 1000);
</script>
<script>
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        const spinner = document.getElementById('spinner');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                if (form.checkValidity()) {
                    spinner.classList.toggle('show');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
function resetForm() {
  document.getElementById("bukutamu-form").reset();
}
</script>
</body>
</html>