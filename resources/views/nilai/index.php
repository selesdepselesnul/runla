<!DOCTYPE html>
<html>
<head>
    <title>Nilai</title>
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/nilai.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/dt-1.10.12/datatables.min.css"/>
 


</head>
<body>
<div class="container-fluid">
    <h2 class="visible-md-block visible-lg-block">Mau lihat nilai semua mahasiswa UNLA ?</h2>
    <h4 class="visible-sm-block">Mau lihat nilai semua mahasiswa UNLA ?<h4>
    <h6 class="visible-xs-block">Mau lihat nilai semua mahasiswa UNLA ?</h6>
    <div class="center-block row">
        <input type="text" class="form-control" id="npmSearchInput" placeholder="masukan npm-nya!">
    </div>
    <div class="modal"></div>
    <div id="gradeTableContainer" class="row center-block hidden">
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
 
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/dt-1.10.12/datatables.min.js"></script>
<script src="js/underscore-min.js"></script>
<script type="text/javascript">    

$(document).ready(function() {
    var body = $("body");
    var table;
    $(document).on({
        ajaxStart: function() { body.addClass("loading");    },
         ajaxStop: function() { body.removeClass("loading"); }    
    });

        function showGrade() {
        var npm = $('#npmSearchInput').val();

        if (npm.length == 14) {
            
            if(table != null)
                table.destroy()
            
            $('#gradeTableContainer').removeClass('hidden');
            
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

    $('#npmSearchInput').on('keyup', showGrade);
})
</script>
</body>
</html>