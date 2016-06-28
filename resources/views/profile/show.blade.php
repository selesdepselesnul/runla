@extends('master')
@section('content')
<div id="profileText" class="center-block">
    
</div>
@endsection
@section('customjs')
<script type="text/javascript">
$(document).ready(function() {
    $('#profileText').hide();
    var body = $("body");
    $(document).on({
        ajaxStart: function() { body.addClass("loading");    },
        ajaxStop: function() { 
            body.removeClass("loading"); 
            $('#profileText').show();
        }    
    });
    $.get(
        "http://www.siakapi.selesdepselesnul.com/profile/npm/"+{{ $npm }}, 
        function(profile) {
            var studentProfile = profile.data;
            if(studentProfile) {
                var profileText = _.each(studentProfile, function(val, key) {
                    $('#profileText').append('<p>' + key + ' : ' + val + '</p>');    
                });
                
                console.log(profileText);
            }
        }, 
        "json");    
});    

</script>
@endsection