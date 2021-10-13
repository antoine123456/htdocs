$(document).ready(function(){
    $('.login_button').click(function(){
        var username=$('#username').val();
        var password=$('#password').val();
       
        if(username!=''&&password!=''){
            
            $.ajax({
                url:"pages/ajaxConn1.php",
                method:"POST",
                data:{username:username,password:password},
                success:function(data){
    
                    if(data == 1 ){
                        $('#loginModal').hide();
                        location.reload();
                        
                    }else{
                        alert('Mauvais pseudo/mdp');
                    }
                }
            });
        }else{
            alert('Remplis tout les champs');
        }
    });
});
$(document).ready(function(){
    $('.login_button1').click(function(){
        var username=$('#usr').val();
        var password=$('#pass').val();
        if(username!=''&&password!=''){
            
            $.ajax({
                url:"pages/ajaxConn1.php",
                method:"POST",
                data:{username:username,password:password},
                success:function(data){
    
                    if(data == 1 ){
                        $('#loginModal1').hide();
                        location.reload();
                        
                    }else{
                        alert('Mauvais pseudo/mdp');
                    }
                }
            });
        }else{
            alert('Remplis tout les champs');
        }
    });
});
$(document).ready(function(){
    $('.nvcomp').click(function(){
        var username=$('#nom').val();
        var password=$('#mdp').val();
        if(username!=''&&password!=''){
            $.ajax({
                url:"pages/ajaxNouv1.php",
                method:"POST",
                data:{username:username,password:password},
                success:function(data){
                    console.log(data);
                    if(data==0){
                        alert('Pseudo utilisé');
                    }else{
                        $('#nvcom').hide();
                        $('#loginModal1').modal('show');
                    }
                }
            });
        }else{
            alert(' tout les champs');
        }
    });
});
$(document).ready(function(){
    $('.presentacion').click(function(){
        var userid = $(this).data('id'); 
        $('.envmess').click(function(){
            var commentaire=$('#comm').val();
            var attache=userid;
            if(commentaire!=''){
                $.ajax({
                    url:"pages/ajaxComm.php",
                    method:"POST",
                    data:{commentaire:commentaire,attache:attache},
                    success:function(data){
                        if(data == 1 ){
                            alert('envoyée');
                            $('#presentation').modal('hide');
                        }else{
                            alert('erreur?');
                        }
                    }
                });
            }else{
                alert("vide");
            }
        });
        $.ajax({
            url: 'pages/ajaxSite.php',
            type: 'post',
            data: {userid: userid},
            success: function(response){
                $('.aff').html(response);
                $('#presentation').modal('show');
            }
        });
    });
});
$(document).ready(function(){
    $('#presentation').on("hidden.bs.modal", function () {
        $( ".envmess").unbind( "click" );
    });
});
$(document).ready(function(){
    $('.messagerie').click(function(){
        $.ajax({
            url:"pages/ajaxMessagerieV2.php",
            method:"POST",
            success:function(data){
               $('.affiche').html(data);
               $('#messagerie').modal('show');
            }
        });
    });
});
/* $(document).ready(function(){
    $('#messagerie').on("hidden.bs.modal", function () {
        $( ".envmessp").unbind( "click" );
    });
}); */


$(document).ready(function(){
    $('.perso').click(function(){
        var userid = $(this).data("id");
       
            $.ajax({
            url:"./pages/ajaxMessPers.php",
            method:"POST",
            data:{userid:userid},
            success:function(data){
                $('#presentation').modal('hide');
               $('.affichage').html(data);
               $('#messagerie').modal('hide');
               $('#messageriz').modal('show');
               
            }
        });
        $.ajax({
            url:"./pages/ajaxMessPersButton.php",
            method:"POST",
            data:{userid:userid},
            success:function(data){
               $('.booton').html(data);
            }
        }); 
     
       
    });
});


/* var owl = $('.owl-carousel');
owl.owlCarousel({
    loop: true,
    margin: 20,
    autoplay: true,
    slideTransition: 'linear',
    autoplayTimeout: 0,
    autoplaySpeed: 3000,
    autoplayHoverPause: false,
    responsive:{
        0:{
            items:1
        },
        600:
        {
            items:2
        },
        900:{
            items:3
        },
        1500:{
            items:5
        },
        3000:{
            items:5
        }
    },
    navText:['<svg viewBox="0 0 24 24"><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path></svg>','<svg viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path></svg>']
}) 
owl.on('mousewheel', '.owl-stage', function (e) {
        console.log(e.originalEvent.deltaY)
    if (e.originalEvent.deltaY>0) {
        owl.trigger('next.owl');
    } if (e.originalEvent.deltaY<0){
        owl.trigger('prev.owl');
    }
    if (e.originalEvent.deltaX<0) {
        owl.trigger('next.owl');
    } if (e.originalEvent.deltaX>0){
        owl.trigger('prev.owl');
    }
    e.preventDefault();
}); */
$(document).ready(function () {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        margin: 20,
        autoplay: true,
        slideTransition: 'linear',
        autoplayTimeout: 0,
        autoplaySpeed: 8000,
        autoplayHoverPause: false,
        responsive:{
            0:{
                items:1
            },
            600:
            {
                items:2
            },
            900:{
                items:3
            },
            1500:{
                items:5
            },
            3000:{
                items:5
            }
        }
    });
owl.on('mousewheel', '.owl-stage', function (e) {
    console.log(e.originalEvent.deltaY)
if (e.originalEvent.deltaY>0) {
    owl.trigger('next.owl');
} if (e.originalEvent.deltaY<0){
    owl.trigger('prev.owl');
}
if (e.originalEvent.deltaX<0) {
    owl.trigger('next.owl');
} if (e.originalEvent.deltaX>0){
    owl.trigger('prev.owl');
}
e.preventDefault();
});
});

