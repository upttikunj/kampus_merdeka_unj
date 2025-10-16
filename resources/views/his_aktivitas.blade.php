@extends('layouts.main')
@section('contain')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $title }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">{{ $title }}</a></li>
            <li class="breadcrumb-item active">{{ $subtitle }}</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">History Aktivitas</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button> --}}
        </div>
      </div>
      <div class="card-body">
        
            <fieldset>
                <legend>Data Mahasiswa</legend>
                <div class="mb-1 row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Periode Aktivitas</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="118 (2022/2023 Genap)">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa (NIM)</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="1512621031">
                    </div>
                </div>
                <div class="mb-1 row">
                    <label for="staticEmail" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                    <div class="col-sm-7">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Syifa Dzulfikriyah">
                    </div>
                </div>
            </fieldset>
          
      </div>

    </div>
  </section>

  <section class="content">
    {{-- @if ($cmode == '3' || $cmode == '4' || $cmode == '11' || $cmode == '13' || $cmode == '14' || $cmode == '20')
      @include('layouts.infobox')
    @endif --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Aktivitas</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover table-border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Aktivitas</th>
                    <th>Konversi MK</th>
                    <th>Semester</th>
                </tr>
            </thead>

            {{-- <tbody>
                <tr>
                    <td>1</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>4</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>2</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>2</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>4</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>2</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>A</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>12345678</td>
                    <td>Metode Pengajaran</td>
                    <td>2</td>
                    <td>1234567890</td>
                    <td>Dosen</td>
                    <td>A</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td colspan="4">20</td>
                </tr>
            </tfoot> --}}
        </table>
            
      </div>

    </div>
  </section>
@endsection
