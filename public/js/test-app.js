var start = false;
var end = true;

$( document ).ready(function() {
    // start mouse hold
    $(document).on('mousedown', '#table-auth', function () {
        start = true;
        end = false;
        $('#table-auth tr td').removeClass('active');
     });
     // end mouse hold
     $(document).mouseup(function () {
         if(start && !end){
             checkAuth();
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
     //check email
     $(document).on('click', '#btn-check-email', function () {
         checkEmail();
     });
});

/**
* check email by graphql
*/
function checkEmail(){
	try{ 
        var email =$('#email').val();
        var data = [];
        $.ajax({
            method: 'GET',
            url: '/graphql',
            dataType    :   'json',
            data        :   { query: `{ user( email: "${email}" ) {id} }` },
            contentType: 'application/json',
            success: function(res) {
                var data = res.data.user;
                if(data && data.id){
                    $('#form-email').addClass('hidden');
                    $('#table-auth').removeClass('hidden');
                }else{
                    window.location = "/register";
                }
            },
            error: function (jqXHR, exception) {
                swal("Check auth has error", "", "error");
            }
        });
    }catch(e){
        console.log('checkMail:' + e.message);
    }
}

/**
* check auth by graphql
*/
function checkAuth(){
	try{ 
        var email =$('#email').val();
        var data = [];
        $('#table-auth tr td.active').each(function() {
            data.push({
                row: $(this).attr('row'),
                column: $(this).attr('column'),
            })
        });
        var auth = renderAuth(email, data);
        $.ajax({
            method: 'GET',
            url: '/graphql',
            dataType    :   'json',
            data        :   { query: `{ user( auth: "${auth}" ) {id} }` },
            contentType: 'application/json',
            success: function(res) {
                var data = res.data.user
                if(data && data.id){
                    getProfile(auth);
                }else{
                    swal("Your hash is not correct", "Hashes: " + auth , "error");
                }
            },
            error: function (jqXHR, exception) {
                swal("Check auth has error", "", "error");
            }
        });
    }catch(e){
        console.log('checkAuth:' + e.message);
    }
}

/**
* clear profile
*/
function clearProfile(){
	$('.file-preview').css('background-image', 'url(/assets/images/avatars/user.png)');
    $('#full-name').text("");
    $('#phone-number').text("");
    $('#gender').text("");
    $('#birthday').text("");
    $('#about').text("");
    $('#auth').text("");
}

/**
* get profile
*/
function getProfile(auth){
	try{
        clearProfile();
        //call api graphql
        $.ajax({
            method: 'GET',
            url: '/graphql',
            dataType    :   'json',
            data        :   { query: `{ user( auth: "${auth}" ) {avatar name phone gender birthday about auth} }` },
            contentType: 'application/json',
            success: function(res){
                var data = res.data.user;
                if(data){
                    $('.file-preview').css('background-image', 'url('+ path_avatar + data.avatar +')');
                    $('#full-name').text(data.name);
                    $('#phone-number').text(data.phone);
                    var gender = ""
                    if(data.gender == 0){
                        gender="Male";
                    }else if(data.gender == 1){
                        gender="Female";
                    }
                    $('#gender').text(gender);
                    $('#birthday').text(data.birthday);
                    $('#about').text(data.about);
                    $('#auth').text(data.auth);
                }
                $('#table-auth').addClass('hidden');
                $('#user-profile').removeClass('hidden');
            },
        })
    }catch(e){
        console.log('getProfile:' + e.message);
    }
}