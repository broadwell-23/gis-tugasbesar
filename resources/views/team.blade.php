@extends('layouts.blank-admin')

@push('stylesheets')
    <!-- Bootstrap core CSS -->
    <link href="adm/css/bootstrap.min.css" rel="stylesheet">
    <link href="adm/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="adm/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="adm/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
    <link href="adm/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="adm/assets/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" href="adm/assets/data-tables/DT_bootstrap.css" />
    <link href="adm/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="adm/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="adm/css/style.css" rel="stylesheet">
    <link href="adm/css/style-responsive.css" rel="stylesheet" />
@endpush

@section('main_container')
<!--main content start-->
<section id="main-content">
  <section class="wrapper">
      <div class="row">
          <div class="col-lg-12">
              <section class="panel">
                 <header class="panel-heading">
                      Team Management
                  </header>
                  <div class="panel-body">
                    <div class="adv-table">
                      <table class="display table table-bordered table-striped" id="example">
                          <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Nim</th>
                              <th>Foto</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>

                          @foreach($teams as $no => $team)
                          <tr>
                              <td>{{ $no+1 }}</td>
                              <td>{{ $team->nama }}</td>
                              <td>{{ $team->nim }}</td>
                              <td>{{ $team->foto }}</td>
                              <td>
                                <center>
                                <button class="btn btn-primary btn-xs" data-toggle="modal" href="#modalUbah{{ $team->id }}"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs" data-toggle="modal" href="#modalHapus{{ $team->id }}"><i class="fa fa-trash-o"></i></button>
                                </center>
                              </td>
                          </tr>
                          @endforeach
                          </tbody>
                      </table>
                    </div>
                  </div>
              </section>
          </div>
      </div>
  </section>
</section>

<!-- MODAL COLLECTIONS -->
 @foreach($teams as $no => $team)
  <!-- Modal update -->
  <div class="modal fade" id="modalUbah{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Ubah Team</h4>
              </div>
              <div class="modal-body">

                <form action="{{ url('/team') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $team->id }}">

                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                          <input name="nama" type="text" placeholder="" class="form-control" required="" value="{{ $team->nama }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Nim</label>
                        <div class="col-sm-9">
                          <input name="nim" type="text" placeholder="" class="form-control" required="" value="{{ $team->nim }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-sm-3 control-label">Foto</label>
                        <div class="col-sm-9">
                          <input name="foto" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Ubah</button>
                    </div>

                </form>

              </div>
          </div>
      </div>
  </div>
  <!-- END modal update-->

  <!-- Modal Hapus -->
    <div class="modal fade" id="modalHapus{{ $team->id }}" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header alert alert-danger">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Warning!</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/team') }}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="{{ $team->id }}">

                <center>
                    <p>Apakah anda yakin ingin menghapus titik wifi cafe <b>{{ $team->nama }}</b>?</p>
                </center>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya</button>
                </div>
            </form>
          </div>

        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /END modal Hapus -->
  @endforeach
<!-- END MODAL COLLECTIONS -->
@endsection

@push('scripts')
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="adm/js/jquery.js"></script>
    <script src="adm/js/jquery-1.8.3.min.js"></script>

    <script src="adm/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="adm/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="adm/js/jquery.scrollTo.min.js"></script>
    <script src="adm/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="adm/js/jquery.sparkline.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="adm/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="adm/assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="adm/assets/gritter/js/jquery.gritter.js"></script>
    <script src="adm/js/respond.min.js" ></script>
    <script type="text/javascript" src="adm/js/jquery.pulsate.min.js"></script>

    <!--common script for all pages-->
    <script src="adm/js/common-scripts.js"></script>

    <!--script for this page only-->
    <script src="adm/js/gritter.js" type="text/javascript"></script>
    <script src="adm/js/pulstate.js" type="text/javascript"></script>

    <!--script for this page only-->

    <script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
          $('#example').dataTable( {
              "aaSorting": [[ 0, "asc" ]]
          } );
      } );
    </script>

    <!-- untok validasi -->
    <script type="text/javascript">
      function countTitle() {
        var val = $('#SEOtitle').val();
        var count = val.length;
          $('#countTitle').text(count);
          if (count==0) {
            document.getElementById("countTitle").style.color = "black";
          } else if(count<=50) {
            document.getElementById("countTitle").style.color = "blue";
          } else {
            document.getElementById("countTitle").style.color = "red";
          }
      }

      function count() {
        var val = $('#SEOdesc').val();
        var count = val.length;
        $('#count').text(count);
        if (count==0) {
          document.getElementById("count").style.color = "black";
        } else if(count<=150) {
          document.getElementById("count").style.color = "blue";
        } else {
          document.getElementById("count").style.color = "red";
        }
      }

      function check(data) {
        if ($('#judul').val() == '') {
          $('#hintjudul').text('Harap isi Judul!');
          document.getElementById("hintjudul").style.color = "red";
          alert('Harap isi Judul!') ;
          return false ;
        }
        var editor_val = CKEDITOR.instances.deskripsi.getData(); ;
        if (editor_val == '') {
          $('#hint').text('Harap isi Deskripsi!');
          document.getElementById("hint").style.color = "red";
          document.getElementById("hint").style.textAlign = "center";
          alert('Harap isi Deskripsi!') ;
          var array = $(data).serialize();
          console.log(array);
          return false ;
        }
        if ($('#thumbnail').val()=='') {
          $('#hintThumb').text('Harap isi Gambar Utama!');
          document.getElementById("hintThumb").style.color = "red";
          alert('Harap isi Gambar Utama!') ;
          return false;
        }
        return true ;
      }
    </script>
@endpush
