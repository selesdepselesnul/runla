@extends('master')

@section('uppercustomjs')
@endsection

@section('content')
<h1 class="visible-md-block visible-lg-block"><u>Profile</u></h1>
<h4 class="visible-sm-block"><u>Profile</u><h4>
<h6 class="visible-xs-block"><u>Profile</u></h6>
<div class="modal"></div>
<div id="profileText" class="center-block"></div>
@endsection

@section('customjs')
<script type="text/javascript">
$('#profileText').hide();
var body = $("body");
$(document).on({
    ajaxStart: function() { body.addClass("loading");    },
    ajaxStop: function() { 
        body.removeClass("loading"); 
        $('#profileText').show();
    }    
});
function checkIfNull(data) {
    return data == '' || data == null ? '-' : data;
}
$(document).ready(function() {

    $.get(
        "http://www.siakapi.selesdepselesnul.com/profile/npm/"+{{ $npm }}, 
        function(profile) {
            var studentProfile = profile.data;
            if(studentProfile == null) {
                 $('#profileText').append(
                    '<p class="visible-xs-block" style="font-size: 14px">yang bersangkutan tidak berkenan profilenya ditampilkan<br/>'
                    +'anda tidak berkenan ?<br/>'
                    +'hubungi : <a href="mailto:selesdepselesnul@gmail.com?Subject=TidakBerkenan" target="_top">selesdepselesnul@gmail.com</a></p>');
                 $('#profileText').append(
                    '<p class="visible-sm-block" style="font-size: 20px">yang bersangkutan tidak berkenan profilenya ditampilkan<br/>'
                    +'anda tidak berkenan ?<br/>'
                    +'hubungi : <a href="mailto:selesdepselesnul@gmail.com?Subject=TidakBerkenan" target="_top">selesdepselesnul@gmail.com</a></p>');
                $('#profileText').append(
                    '<p class="visible-md-block visible-lg-block" style="font-size: 40px">yang bersangkutan tidak berkenan profilenya ditampilkan<br/>'
                    +'anda tidak berkenan ?<br/>'
                    +'hubungi : <a href="mailto:selesdepselesnul@gmail.com?Subject=TidakBerkenan" target="_top">selesdepselesnul@gmail.com</a></p>');
                console.log(profileText);
            } else {
                var profileText = _.each(studentProfile, function(val, key) {
                    $('#profileText').append(
                        '<p class="visible-xs-block" style="font-size: 14px">' + key + ' : ' + checkIfNull(val) + '</p>'); 
                    $('#profileText').append(
                        '<p class="visible-sm-block" style="font-size: 20px">' + key + ' : ' + checkIfNull(val) + '</p>');       
                    $('#profileText').append(
                        '<p class="visible-md-block visible-lg-block" style="font-size: 40px">' + key + ' : ' + checkIfNull(val) + '</p>');    
                });
            }
        }, 
        "json");    
});    
</script>
@endsection