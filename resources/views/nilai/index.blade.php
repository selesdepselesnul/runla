@extends('master')
@section('customcss')
    <link rel="stylesheet" type="text/css" href="css/nilai.css">
@endsection

@section('content')
    <h2 class="visible-md-block visible-lg-block">Mau lihat nilai semua mahasiswa UNLA ?</h2>
    <h4 class="visible-sm-block">Mau lihat nilai semua mahasiswa UNLA ?<h4>
    <h6 class="visible-xs-block">Mau lihat nilai semua mahasiswa UNLA ?</h6>
    <div class="center-block row">
        <input type="text" class="form-control" id="npmSearchInput" placeholder="tulis npm-nya disini!">
    </div>
    <input id="seeProfile" class="btn btn-default hidden" type="button" value="lihat profile mahasiswa">
    <div id="profileDialog" title="Basic dialog" class="hidden row">
        <textarea id="profileTextArea" disabled="disabled" class="row"></textarea>
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
    <footer>
        <h2 class="visible-md-block visible-lg-block">runla &copy <?php echo date('Y') ?> by <a href="https://github.com/selesdepselesnul">selesdepselesnul</a></h2>
        <h4 class="visible-sm-block">runla &copy <?php echo date('Y') ?> by <a href="https://github.com/selesdepselesnul">selesdepselesnul</a><h4>
        <h6 class="visible-xs-block">runla &copy <?php echo date('Y') ?> by <a href="https://github.com/selesdepselesnul">selesdepselesnul</a></h6>
    </footer>
@endsection
@section('customjs')
    <script type="text/javascript">   
    $('#seeProfile').click(function() {
        var npm = $('#npmSearchInput').val();
        $.get(
            "http://www.siakapi.selesdepselesnul.com/profile/npm/"+npm, 
            function(profile) {
                var studentProfile = profile.data;

                if(studentProfile) {
                    var profileText = _.reduce(studentProfile, function(memo, val, key) {
                        return memo + '\n' + key + " : " + (val == null || val == '' ? '-' : val)
                    });
                    console.log(profileText);
                    $('#profileDialog').removeClass('hidden');
                    $('#profileDialog').dialog({
                        title : 'Profile ',
                        width : 40,
                        height : 40
                    });
                    $('#profileTextArea').text(profileText);
                } else {
                    $('#profileDialog').removeClass('hidden');
                    $('#profileDialog').dialog({
                        title : 'Profile',
                        width : 40,
                        height : 40
                    });
                    $('#profileTextArea').text(
                        'yang bersangkutan tidak berkenan dilihat profilenya\nanda tidak berkenan ? \nhubungi selesdepselesnul@gmail.com');
                }
               
            }, "json" );
    }); 
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
                         "language": {
                            "lengthMenu": "Nampilin _MENU_ matkul per halaman",
                            "zeroRecords": "Nggak ada - sorry",
                            "info": "Nampilin halaman _PAGE_ dar i _PAGES_",
                            "infoEmpty": "Nggak ada yang cocok",
                            "infoFiltered": "(difilter dari _MAX_ total matkul)",
                            "paginate": {
                              "previous": "Sebelumnya",
                              "next": "Berikutnya"
                            },
                            "search": "Sok di filter"
                        },
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
                    $('#seeProfile').removeClass('hidden');
                }
                
            }
        }

        $('#npmSearchInput').keyup(showGrade);
    })
    </script>
@endsection