@extends('master')
@section('customcss')
    <link rel="stylesheet" type="text/css" href="css/nilai.css">
@endsection
@section('content')
    <h2 class="visible-md-block visible-lg-block">Mau lihat nilai semua mahasiswa UNLA ?</h2>
    <h4 class="visible-sm-block">Mau lihat nilai semua mahasiswa UNLA ?<h4>
    <h6 class="visible-xs-block">Mau lihat nilai semua mahasiswa UNLA ?</h6>
    <div class="center-block row">
        <input type="text" class="form-control" id="npmSearchInput" placeholder="masukan npm-nya!">
    </div>
    <div class="modal"></div>
    <div id="gradeTableContainer" class="row center-block">
        <div class="table-responsive">
            <table id="gradesTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Matkul</th>
                        <th>Mutu</th>
                        <th>N. Angka</th>
                        <th>N. Huruf</th>
                        <th>SKS</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('customjs')
    <script type="text/javascript">    
    $('#gradeTableContainer').hide();
    $(document).ready(function() {
        var body = $("body");
        var table;
        $(document).on({
            ajaxStart: function() { body.addClass("loading");    },
             ajaxStop: function() { 
                body.removeClass("loading"); 
                $('#gradeTableContainer').show();
            }    
        });

        function showGrade(event) {
            var key = event.which;
            var npm = $('#npmSearchInput').val();
            console.log(event);

            if (npm.length == 14) {
                console.log(key);
                if(!(key >= 37 && key <= 40)) {
                    if(table != null)
                    table.destroy()
                    $('#gradeTableContainer').fadeIn(10000);
                    table = $('#gradesTable').DataTable({
                        "ajax": "http://www.siakapi.selesdepselesnul.com/nilai/npm/"+npm,
                        "columns": [
                            { "data": "kode" },
                            { "data": "matkul" },
                            { "data": "mutu" },
                            { "data": "nilaiangka" },
                            { "data": "nilaihuruf",
                              "render": function(grade) {
                                if(grade == 'A' || grade == 'B')
                                    return '<span class="label label-success">'+grade+'</span>';
                                else if(grade == 'C' || grade == 'D')
                                    return '<span class="label label-warning">'+grade+'</span>';
                                else if(grade == 'E')
                                    return '<span class="label label-danger">'+grade+'</span>';
                                else
                                    return '<span class="label label-default">'+grade+'</span>';
                              } 
                            },
                            { "data": "sks" }
                        ]
                    });  
                }
                
            }
        }

        $('#npmSearchInput').keyup(showGrade);
    })
    </script>
@endsection