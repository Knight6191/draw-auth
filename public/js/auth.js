var start = false;
var end = true;

$( document ).ready(function() {
    // start click
    $(document).on('mousedown', '#table-auth', function () {
       start = true;
       end = false;
       $('#table-auth tr td').removeClass('active');
    });
    // end click
    $(document).mouseup(function () {
        if(start && !end){
            saveAuth();
        }
        start = false;
        end = true;
    });
    // hover item when hold mouse
    $('#table-auth tr td').mouseover(function () {
        if(start && !end){
            $(this).addClass('active');
        }
    });
});

/**
* save auth
*/
function saveAuth(){
	try{ 
        var data = [];
        $('#table-auth tr td.active').each(function() {
            data.push({
                row: $(this).attr('row'),
                column: $(this).attr('column'),
            })
        });
        var auth = renderAuth(email, data);
        //
        $.ajax({
            type        :   'POST',
            url         :   '/main/save-auth',
            dataType    :   'json',
            data        :   {auth},
            success: function(res) {
                swal("Save draw auth has success", "", "success");
            },
        });
    }catch(e){
        console.log('saveAuth:' + e.message);
    }
}