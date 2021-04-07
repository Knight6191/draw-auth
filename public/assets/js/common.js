const text_auth =   'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan felis id ante\
                      tempus vestibulum. Ut non dapibus dolor. Fusce cursus ac diam non consequat. Nunc\
                    aliquam nulla elit, in tempor massa semper eget. Ut ultricies sit amet nibh fermentum\
                    fringilla. Quisque vitae imperdiet sem. Nunc eu leo nec urna vestibulum bibendum. Sed\
                    sit amet mauris nisl. Mauris venenatis pellentesque.'

$( document ).ready(function() {                    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/**
* render hash md5
*/
function renderAuth(email, data){
    var auth = "";
    //convert string to array
    var array_auth = text_auth.match(/[a-zA-Z]+/g);
    //convert to array 10 x 6
    var matrix = [];
    var index = 0;
    for(var row = 0; row < 6; row++){
        matrix[row] = [];
        for(var column = 0; column < 10; column++){
            matrix[row][column] = array_auth[index];
            index ++;
        }
    }
    //
    data.forEach(function (item) {
        auth += matrix[item['row']][item['column']];
    });
    auth = email + ":" + auth;
    return md5(auth);
}