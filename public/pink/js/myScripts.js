jQuery(document).ready(function ($){
   $('.commentlist li').each(function (i){
       $(this).find('div.commentNumber').text('#'+(i+1));
   });
   $('#commentform').on('click','#submit',function(e){
       e.preventDefault();
       var comParent = $(this);
       $('.wrap_result').css('color','green').text('Збереження коментара').fadeIn(5,function(){
               var data = $('#commentform').serializeArray();

               $.ajax({
                   url:$('#commentform').attr('action'),
                   data:data,
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   type:'POST',
                   dataType:'JSON',
                   success:function (html){
                        if(html.error)
                        {
                        }
                        else if (html.success)
                        {
                            $('.wrap_result').append('<br/><strong>Збережено</strong></strong>').delay(2).fadeOut(5,function (){
                                alert(html.data.parent_id);
                                if(html.data.parent_id > 0){
                                        alert('ok');
                                        comParent.parents('div#respond').prev().after('<ul class="children">'+html.comment + '</ul>');

                                    }                                })
                        }
                   },
                   error:function (){

                   }
               });
           });
   });
});
