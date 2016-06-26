<!DOCTYPE html>
<html>
<head>
    <title>Nilai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/nilai.css">

</head>
<body>
<div class="container">
    <div class="center-block row">
        <input type="text" class="form-control" id="npmSearchInput" placeholder="npm">
    </div>
    <div class="row">
        <table class="table table-hover">
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
            <tbody id="grades">
                
            </tbody>    
        </table>
    </div>
    <div class="modal"></div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="js/underscore-min.js"></script>
<script type="text/javascript">
    var body = $("body");

    $(document).on({
        ajaxStart: function() { body.addClass("loading");    },
         ajaxStop: function() { body.removeClass("loading"); }    
    });
    $('#npmSearchInput').on('change keyup', function() {
        var npm = $('#npmSearchInput').val();
        if (npm.length == 14) {
            $('.grade').remove();
            $.get( "http://siakapi.selesdepselesnul.com/nilai/npm/"+npm, function(grades) {
              _.each(grades, function(x) {
                $('#grades').append(
                    '<tr class="grade">'
                       +'<td>'+x.kode+'</td>'
                       +'<td>'+x.matkul+'</td>'
                       +'<td>'+x.mutu+'</td>'
                       +'<td>'+x.nilaiangka+'</td>'
                       +'<td>'+x.nilaihuruf+'</td>'
                       +'<td>'+x.sks+'</td>'
                   +'</tr>'
                );
              });
            });
        }
            
    });
</script>
</body>
</html>