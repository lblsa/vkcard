var users, user;
$(function(){
  $('#dropzone').click(function(){
      $('#fileupload').click();
  });
  
  var jqXHR;
  jqXHR = $('#fileupload').fileupload({
      dataType: 'json',
      done: function (e, data) {
          
          var error = 0;

          $.each(data.result.files, function (index, file) {
            

            if (file.error) {
              error = 1
              my_alert(file.error);
            } else {

              var file_url = file.url.replace("files","files/medium");
              $('#cropbox, #preview').attr({'src':file_url,'style':''});

              var img = new Image();
              img.onload = function() {
                var new_w = this.width;
                var new_h = this.height;

                jcrop_api.destroy();
                jcrop_api.disable();
                jcrop_api.enable();

                $('#cropbox, #preview').css({width: new_w, height: new_h});

                $('#cropbox').Jcrop({
                  trueSize: [new_w,new_h],
                  onChange: updatePreview,
                  onSelect: updatePreview,
                  aspectRatio: 1,
                },function(){
                  // Use the API to get the real image size
                  var bounds = this.getBounds();
                  boundx = bounds[0];
                  boundy = bounds[1];
                  // Store the API in the jcrop_api variable
                  jcrop_api = this;
                });
              }
              img.src = file_url;

            }
          });
          $('#progress').fadeOut();

          if (!error)
            $('#upload_alert').hide();
          
          $('#dropzone').html('Перетащите файл сюда или выберите с диска');
      },
      dropZone: $('.drop'),

      drop: function(e, data){
          if (data.files.length > 1) {
            my_alert('Вы можете добавлять файлы только по одному');
            return false;
          }

          $.each(data.files, function (index, file) {
            if ( /^.*\.(png|gif|jpe?g)$/i.test(file.name) ) {
                $('#dropzone').html(file.name);
            } else {
                my_alert('Недопустимый формат');
                jqXHR.abort();
                return false;
            }
          });
      },
      change: function(e, data){
          $.each(data.files, function (index, file) {
            if ( /^.*\.(png|gif|jpe?g)$/i.test(file.name) ) {
                $('#dropzone').html(file.name);
            } else {
                my_alert('Недопустимый формат');
                jqXHR.abort();
                return false;
            }
          }); 
      },
      progressall: function (e, data) {
        $('#progress').show();
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
      },
  }).error(function (jqXHR, textStatus, errorThrown) {
      if (errorThrown === 'abort') {
          alert('File Upload has been canceled');
      }
  });

  var jcrop_api;

  $('.fontsize').change(function(){
    $('#text, #inner_text p').css('font-size',$(this).val()+'px');
  })

  $('#cropbox').Jcrop({
    onChange: updatePreview,
    onSelect: updatePreview,
    aspectRatio: 1,
  },function(){
    // Use the API to get the real image size
    var bounds = this.getBounds();
    boundx = bounds[0];
    boundy = bounds[1];
    // Store the API in the jcrop_api variable
    jcrop_api = this;
  });

  $('#prev_container, .clone').draggable({
    containment: ".card",
    stop: function( event, ui ) {
      $('#prev_container, .clone').css({left:ui.position.left,top:ui.position.top});
      $('#px').val(ui.position.left);
      $('#py').val(ui.position.top);
    }
  });

  $('.clone').resizable({
    alsoResize: "#prev_container",
    aspectRatio: true,
    stop:function( event, ui ){
      var new_x1 = parseInt($('#x').val())+ui.size.width;
      var new_y1 = parseInt($('#y').val())+ui.size.height;
      var anim_to = [ parseInt($('#x').val()), parseInt($('#y').val()), new_x1, new_y1 ];
      jcrop_api.setSelect(anim_to);//setSelect
    }
  });

  $("#inner_text" ).resizable();

  $('#inner_text').draggable({
    containment: ".vin_cont",
    stop: function( event, ui ) {
      $('#tx').val(ui.position.left);
      $('#ty').val(ui.position.top);
    }
  });

  $('.vin').click(function(){
    $('.vin_cont img').attr('src','/vignette/14_'+$(this).val()+'.png');
    $('.vin_cont').show();
    $('#text').show();
  });

  $('#text').keyup(function(){
    $('#inner_text p').html($('#text').val());
  });

  $('#crop').click(function(){
    if (user) {
      var data = {
        px:$('#px').val(),
        tx:$('#tx').val(),
        py:$('#py').val(),
        ty:$('#ty').val(),
        x:$('#x').val(),
        y:$('#y').val(),
        h:$('#h').val(),
        w:$('#w').val(),
        vin:$('.vin').val(),
        img:$('#img').val(),
        text:$('#text').val()
      }

      $.ajax({
        type: "POST",
        url: "/crop.php",
        data:data,
        dataType: "html"
      }).done(function( result ) {
        $('.main').fadeOut();
        $('#result_image').attr('src','/'+result);
        $('#result').fadeIn();
      });
    } else {
     alert('Необходимо выбрать друга');
    }
    return false;
  });

  $('#post_to_wall').click(function(){
    if (user){
      if (VK){
        VK.api('photos.getWallUploadServer', { uid:user.uid}, function(r){
          if (r && r.response) {
            $.ajax({
              type:"POST",
              url:"/upload_to_vk.php",
              data:{
                      url: r.response.upload_url,
                      photo: $('#result_image').attr('src')
                    },
            }).done(function(result){
              VK.api('photos.saveWallPhoto', result, function(r){
                if(r.response) {
                  var args = {
                      owner_id: user.uid,
                      message: 'Отправлено через http://vk.com/app3392840_8253453',
                      attachments : r.response[0].id // <type><owner_id>_<media_id>
                  };

                  VK.api('wall.post', args, function(r){
                    if (r.response) {
                        console.log(r.response.post_id);
                    }
                  });
                }
              })
            })
          }
        });
      }

    } else {
      alert('вы не выбрали друга');
    }
    return false;
  });

  $('#body').on('click','#vk_auth span',function(){
    user = users[parseInt($(this).attr('data-i'))];
    $('#dLabel span').html(user.first_name + ' ' + user.last_name+'<img src="'+user.photo+'" />');
    $('#user_photo').attr('src',user.photo);
    $('#user_name').html(user.first_name + ' ' + user.last_name);
    $('.dropdown').removeClass('open');
    return false;
  });

//{apiId: 3392840}
  if (typeof(VK) != 'undefined'){
    VK.init(function(){
      VK.api('friends.get', {fields:"first_name,last_name,photo"}, function(data) {
          var frCount = data.response.length;
          users = data.response;
          var onlineStr = '';

          for (var i=0; i<frCount; i++) {
            onlineStr += '<li>'+
                          '<span class="btn btn-block" data-i="'+i+'" >'
                            + users[i].first_name + ' ' + users[i].last_name + 
                          '</span>'+
                        '</li>';
          }

          $('#vk_auth').html(onlineStr);
      });
    });
  }
});

function updateCoords(c) {};

function checkCoords(){
  if (parseInt($('#w').val())) return true;
  alert('Please select a crop region then press submit.');
  return false;
};

function updatePreview(c){
  //updateCoords
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#w').val(c.w);
  $('#h').val(c.h);
  $('#img').val( $('#cropbox').attr('src') );


  if (parseInt(c.w) > 0) {
    var rx = 250 / c.w;
    var ry = 250 / c.h;

    $('#preview').css({
      marginLeft: '-' + c.x + 'px',
      marginTop: '-' + c.y + 'px'
    });
    
    $('#prev_container, .clone').css({ width: c.w + 'px', height:  c.h + 'px'});
  }
};

function my_alert(message){
    $('#upload_alert h4, #upload_alert p').remove();
    var alert = '<h4>Warning!</h4><p>'+message+'</p>';
    $('#upload_alert').append(alert).show();
}


/*
1.
VK.api('photos.getWallUploadServer', { uid:1334573}, function(r){
      console.log(r);
});
response: Object
  aid: -14
  mid: 8253453
  upload_url: "http://cs317619.vk.com/upload.php?act=do_add&mid=8253453&aid=-14&gid=0&hash=49aa6c84362fe582a8fef78ae9c00c87&rhash=6bf50c412084fa8f31877c7d989a427a&swfupload=1&api=1&wallphoto=1"

2. Upload to upload_url  <input type="file" name="photo" />
response: 
  {"server": "1234", "photo": "1234", "hash": "12345abcde"}


3.
photos.saveWallPhoto  server, photo, hash, uid

*/