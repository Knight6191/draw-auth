$( document ).ready(function() {
    //event click button upload file in avatar
    $(document).on('click', '.file-preview', function () {
        $('.file-input-avatar').trigger('click');
    });
    //event change when file input avatar
    $(document).on('change', '.file-input-avatar', function () {
        readURL(this);
        var file_name = upload_file(this);
        $('.file-preview .avatar').val(file_name);
    });
    //button save
    $(document).on('click','#btn-save',function(){
        saveProfile();
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
/**
* save profile
*/
function saveProfile(){
	try{ 
            var name =$('#full-name').val();
            var phone = $('#phone-number').val();
            var gender = $('#gender').val();
            var birthday = $('#birthday').val();
            var about = $('#about').val();
            var avatar = $('.file-preview .avatar').val();
            //
            $.ajax({
                type        :   'POST',
                url         :   '/main/save-profile',
                dataType    :   'json',
                data        :   {
                    name,
                    phone,
                    gender,
                    birthday,
                    about,
                    avatar,
                },
                success: function(res) {
                    swal("Save profile has success", "", "success");
                },
            });
        }catch(e){
            console.log('saveProfile:' + e.message);
        }
}
/**
* preview when upload images
*/
 function readURL(input) {
    if (!input.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
        alert('error format');
    } else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.file-preview').attr('style', 'background-image:url(' + e.target.result + ')');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}
/**
 * upload_file
 */
 function upload_file(_this){
    try {
        var _this = $(_this);
        var file_name = '';
        var data = new FormData();
        $.each(_this[0].files, function(i, file) {
            data.append('file-'+i, file);
        });
        // check is cut file name. is_cut_file_name from m001.js
        if ( typeof is_cut_file_name !== "undefined" ) {
            data.append('is_cut_file_name', is_cut_file_name);
        }
        $.ajax({
            url: '/main/upload-file',
            type: 'POST',
            cache: false,
            contentType: false,
            async:false,
            processData: false,
            data: data,
            success: function(res) {
                if (res['response'] == true) {
                    file_name =  res['file_name'];
                    return file_name;
                }else{
                    return '';
                }

            },
        });
        return file_name;

    } catch (e)  {
        alert('backToHome:  ' + e.message);
    }
}