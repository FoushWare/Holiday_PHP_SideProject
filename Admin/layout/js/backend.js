$(function(){
'use strict'

    /**login form trick**/
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    })

/*Start  Add astrick after input field  */

    $('input').each(function(){
       if( $(this).attr('required') == 'required' ){
            $(this).after('<span class="asterisk">*</span>');
        }

    });
/*End  Add astrick after input field  */

/*START of show password*/

    var passfield=$('input:password');
    $('.show-pass').hover(function(){

          passfield.attr('type','text');

    },function(){
          passfield.attr('type','password');

    });
/*End of show password*/


/*Start confirm  of delete button*/

    $('.confirm').click(function(){

        return confirm("Are you sure?");
    });



/*Delete confirm  of delete button*/




}); //End of the file


