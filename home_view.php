    <!-- Fav and touch icons -->
	<link rel="shortcut icon" href="<?=site_url('images/fav.png');?>">

        <script src="<?=site_url('assets/js/strophe.js');?>"></script>
        <script src="<?=site_url('assets/js/flXHR.js');?>"></script>
        <script src="<?=site_url('assets/js/strophe.flxhr.js');?>"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
        <script src="<?=site_url('assets/js/dates.js');?>"></script>
		
		<script>
		  // Additional JS functions here
		  var id;
		  window.fbAsyncInit = function() {
			FB.init({
			  appId      : '531316883597047', // App ID
			  channelUrl : '//riklr.com/dating/channel.html', // Channel File
			  status     : true, // check login status
			  cookie     : true, // enable cookies to allow the server to access the session
			  xfbml      : true  // parse XFBML
			});
			
						// Additional init code here
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					id = response.authResponse.userID;
                                        if(id!=<?=$s_uid?>)
                                            self.location="<?=site_url('');?>";
                                        $('#id').html(id);
                                        
                                        genderedfrnds(id);
                                        check_match(id);
                                        chat_list(id);
                                        
                                     //$('#dp').attr('src','http://graph.facebook.com/'+id+'/picture?width=76&height=76');  
				} else if (response.status === 'not_authorized') {
					// not_authorized
                                        self.location="<?=site_url('');?>";
					//login();
				} else {
					// not_logged_in
                                        // 
                                        self.location="<?=site_url('');?>";
					//login();
				}
			});
			// Additional init code here
			
                    
                     };
  
		  // Load the SDK Asynchronously
		  (function(d){
			 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			 if (d.getElementById(id)) {return;}
			 js = d.createElement('script'); js.id = id; js.async = true;
			 js.src = "//connect.facebook.net/en_US/all.js";
			 ref.parentNode.insertBefore(js, ref);
		   }(document));
                   
                   function filldates(userid,d)
                   {
                       //alert(d.length);
                       
                       var all = '';	var t = ''; var k =''; var v='';
                                            for(var a=0; a<d.length ;a++)
                                                {
                                                    if($("#" + d[a].friendid).length == 0)
                                                        {
                                                            if(d[a].liked)
                                                                    k = 'goldstar';
                                                            else
                                                                    k = 'blackstar';
                                                            if(d[a].selected)
                                                                    {
                                                                            t =  '<img class = "cornerImage " id="corner'+d[a].friendid+'" src="assets/img/corner9.png" style="z-index:4; display:block;"alt="">';
                                                                            v = '<div  id="'+d[a].friendid+'" class = "dateBox pull-left pink" style="z-index:40;">';
                                                                    }
                                                            else
                                                                    {
                                                                            t = '<img class = "cornerImage " id="corner'+d[a].friendid+'" src="assets/img/corner9.png" style="z-index:4; display:none;"alt="">';
                                                                            v = '<div  id="'+d[a].friendid+'" class = "dateBox pull-left" style="z-index:40;">';
                                                                    }
                                                                    all = 
                                                          '<li class="picturesqq span2" >'+
                                                            '<a onClick="open('+userid+','+d[a].friendid+','+d[a].fof+'); return false;">'+
                                                                                                                t+
                                                              '<img class="imag" src="http://graph.facebook.com/'+d[a].friendid+'/picture?width=172&height=172" alt="">'+
                                                                                                        '</a>'+
                                                                                                        '<a>'+
                                                                                                          v+
                                                                                                                '<div >'+
                                                                                                                  '<p class = "dateText" >Interested In</p> '+
                                                                                                                '<img class = "checkGif" src="assets/img/check_med.gif" >'+
                                                                                                                '</div>'+
                                                                                                          '</div>'+
                                                              '<div class = "nameBox pull-left">'+
                                                                '<div class = "name">'+
                                                                  d[a].name+
                                                                '</div>'+
                                                              '</div>'+
                                                                                                          '<div class = "starBox pull-right" id="star'+d[a].friendid+'" >'+
                                                                                                                '<div class = "stars ">'+
                                                                                                                  '<div id="staricon'+d[a].friendid+'" class = "'+k+' staricon"></div>'+
                                                                                                                  '<div id="nostars'+d[a].friendid+'" class="nostars">'+d[a].likes+'</div>'+
                                                                                                                '</div>'+
                                                                                                          '</div>'+
                                                            '</a>'+
                                                          '</li>';
							$('#dates').append(all);
                                                        }
                                                }
                                                $('.loading-bar').hide();
                                                $('.picturesqq').mouseenter(function() {
										  $(this).find('.dateBox').slideDown(100);
										  $(this).find('.nameBox').toggleClass("nameBox nameBox2");
										  $(this).find('.starBox').toggleClass("starBox starBox2");
										});
										$('.picturesqq').mouseleave(function() {
										  $(this).find('.dateBox').slideUp(100);
										  $(this).find('.nameBox2').toggleClass("nameBox2 nameBox");
										  $(this).find('.starBox2').toggleClass("starBox2 starBox");
										});
										$('.starBox').click(function() {
											//alert('sfo');
											//like($settings.userid,$(this).attr('id'));
											var o = ($(this).attr('id')).substring(4);
											// alert($(this).attr('id'));
											if($('#staricon'+o).hasClass('blackstar'))
												{
													$('#staricon'+o).toggleClass("blackstar goldstar");
													$('#nostars'+o).text((parseInt($('#nostars'+o).text()))+1);
												}
											else
												{
													$('#staricon'+o).toggleClass("goldstar blackstar");
													$('#nostars'+o).text((parseInt($('#nostars'+o).text()))-1);
												}
											like($settings.userid,o);
											evt.stopPropagation();
											return false;
										});
										$('.dateBox').click(function(){
											//alert($('#corner'+$(this).attr('id')).css('display'));
											if($('#corner'+$(this).attr('id')).css('display') == 'none')
												{
													$('#corner'+$(this).attr('id')).css('display','block');
													$(this).addClass("pink")
												}
											else
												{
													$('#corner'+$(this).attr('id')).css('display','none');
													$(this).removeClass("pink");
												}
											select($settings.userid,$(this).attr('id'));
											evt.stopPropagation();
											return false;
										});
                   }
                   
                   function genderedfrnds(userid)
                   {
                       $('.loading-bar').show();
                       var gender = ''+<?=$gender?>+'';
                       $.post("<?=site_url('home/getgenderedfriends');?>", {userid: userid,gender:gender,friendid:userid} )
					.done(function(data) {
                                            //alert(data);
                                            var d = JSON.parse(data);
                                            filldates(userid,d);
                                            fillit(userid);
                                        });
                   }
                   function rec(friendid,dito,i,userid)
                   {
                       $('.loading-bar').show();
                       var gender = ''+<?=$gender?>+'';
                       $.post("<?=site_url('home/getgenderedfriends');?>", {friendid: friendid,userid:userid,gender:gender} )
					.done(function(data) {
                                            var d = JSON.parse(data);
                                            filldates(userid,d); 
                                            if((i+1)<dito.length)
                                                rec(dito[i].friendid,dito,i+1,userid);
                                        });
                   }
                   
                   function fillit(userid)
                   {
                       $.post("<?=site_url('home/getfriends');?>", {userid: userid,friendid:userid} )
					.done(function(data) {
                                            //alert(data);
                                            var gender = ''+<?=$gender?>+'';
                                            var d = JSON.parse(data);
//                                            if(d.length>1)
//                                                rec(d[0].friendid,d,1,userid);
//                                            else
//                                                rec(d[0].friendid,d,0,userid);
                                             getfriends(d,gender,userid);
                                        });
                   }
                   
                   function modalInt(){
                       select(($('#id').html()),($('#fid').html()));
                       if($('#modal-intrested').hasClass('label-important'))
                           {
                               $('#modal-intrested').removeClass('label-important');
                               $('#corner'+($('#fid').html())).hide();
                               $('#'+($('#fid').html())).removeClass('pink');
                           }
                       else
                           {
                               $('#modal-intrested').addClass('label-important');
                               $('#corner'+($('#fid').html())).show();
                               $('#'+($('#fid').html())).addClass('pink');
                           } 
                   }
                   
                   $( document ).ready(function() {
                       var gender = ''+<?=$gender?>+'';
                       var add = "?list='switch'";
                       if(gender == 'null')
                            $('.sidebar').append('<li><a href="<?=site_url('home');?>'+add+'"><span>Switch Gender</span></a></li>');
                       else
                           $('.sidebar').append('<li><a href="<?=site_url('home');?>"><span>Switch Gender</span></a></li>');
                       
                       $('#email-form').submit(function() {
                          var email = $('#email-email').val();
                          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                            if(!regex.test(email)) {
                                $('#email-error').show();
                            }
                            else
                                {
                                    $('#Modal-email').modal('hide');
                                    $.post("<?=site_url('home/invite');?>", {email: email} )
					.done(function(data) {
                                            
                                        });
                                }
                                
                            
                          return false;
                        });
                    });
                   //for notification
                   function check_match(userid)
                   {
                        $.post("<?=site_url('home/check_match');?>", {userid: userid} )
					.done(function(data) {
                                            var d = JSON.parse(data);
                                            var count = 0;
                                            for(var i=0;i<d.length;i++)
                                                {
                                                    $('#notif').prepend('<li><a href="http://riklr.com/dating/chat/session/'+d[i].nick+'">You have got a match! ('+d[i].nick+')</a></li>');
                                                    if(d[i].seen == 0)
                                                        count++;
                                                }
                                                if(count>0)
                                                    $('.notifNumber').html('('+count+')');
                                                if(d.length==0)
                                                    $('#notif').prepend('<li>No notifications yet</li>');
                            });
                   }
                   //for chat list
                   function chat_list(userid)
                   {
                       $.post("<?=site_url('home/chat_list');?>", {userid: userid} )
					.done(function(data) {
                                            var d = JSON.parse(data);
                                            //alert(data);
                                            var arr = [];
                                            $.post("<?=site_url('home/offlinemsgs');?>", {userid: userid} )
                                                        .done(function(data) {
                                                            var off = JSON.parse(data);
                                                            
                                                            if(off.length>0)
                                                                $('.msgNumber').html('('+off.length+')');
                                                                for(var j=0;j<off.length;j++)
                                                                {
                                                                    //alert('in');
                                                                    var full_jid = $(off[j].xml).attr('from');
                                                                    var jid = Strophe.getNodeFromJid(full_jid);
                                                                    if($.inArray(jid, arr) == -1)
                                                                        arr.push(jid);
                                                                }
                                                                
                                                                for(var i=0;i<d.length;i++)
                                                                {
                                                                    if($.inArray(d[i].hash, arr) != -1)
                                                                        {
                                                                            if(d[i].revealed == 0)
                                                                                 $('#msg').prepend('<li><a href="http://riklr.com/dating/chat/session/'+d[i].nick+'">'+d[i].nick+' (unread msgs)</a></li>');
                                                                            else
                                                                                 $('#msg').prepend('<li><a href="http://riklr.com/dating/chat/session/'+d[i].nick+'">'+d[i].user2[0].name+' (unread msgs)</a></li>');
                                                                        }
                                                                    else
                                                                    {
                                                                       if(d[i].revealed == 0)
                                                                        $('#msg').prepend('<li><a href="http://riklr.com/dating/chat/session/'+d[i].nick+'">'+d[i].nick+'</a></li>');
                                                                       else
                                                                        $('#msg').prepend('<li><a href="http://riklr.com/dating/chat/session/'+d[i].nick+'">'+d[i].user2[0].name+'</a></li>');
                                                                    }
                                                                }
                                                                if(d.length>0)
                                                                    {
                                                                        $('#chatref').attr('href','http://riklr.com/dating/chat/session/'+d[(d.length)-1].nick);
                                                                    }
                                                                else
                                                                    $('#msg').prepend('<li>No matches yet</li>');    
                                                                
                                                             });                                                     
				});
                   }
                   function getfriends(arr,gender,userid)
                   {
                       //alert(id);
                        $('#dates').scrollPagination({

                                nop     : 24, // The number of posts per scroll to be loaded
                                offset  : 0, // Initial offset, begins at 0 in this case
                                error   : 'No More Posts!', // When the user reaches the end this is the message that is
                                                            // displayed. You can change this if you want.
                                delay   : 500, // When you scroll down the posts will load after a delayed amount of time.
                                               // This is mainly for usability concerns. You can alter this as you see fit
                                scroll  : true, // The main bit, if set to false posts will not load as the user scrolls. 
                                               // but will still load if the user clicks.
                                gender  : gender,
                                userid : userid,
                                friendid : arr
                        });
                   }
                   
                   
                   //for modal
                   function open(a,b,c){
//                       $.post("<?=site_url('home/get_user');?>", {userid: b} )
//					.done(function(data) {
//                                            
//                                        var l = JSON.parse(data); 
//					if(l.length == 0)
//                                            {
//                                                if(c == false)
//                                                    {
                                                        $.post("<?=site_url('home/get_friend');?>", {id: b} )
                                                            .done(function(da) {
                                                            var nf = JSON.parse(da);
                                                            var p = 'http://graph.facebook.com/'+nf[0].friendid+'/picture?width=350&height=350';
//                                                        setimagemodal(p,p,p,p,p);
                                                            if($('#'+nf[0].friendid).hasClass('pink'))
                                                                $('#modal-intrested').addClass('label-important');
                                                            else
                                                                $('#modal-intrested').removeClass('label-important');
                                                            $('#fid').html(nf[0].friendid);
                                                            $('.mainImage').find('img').attr('src',p);
                                                        $('.modalHeadText').html(nf[0].name);
                                                        if(nf[0].location != 'null')
                                                            $('#localtion').html(nf[0].location);
                                                        else
                                                            $('#localtion').html('');
        //                                                $('#mtext').html('Know more about '+(l[0].name).split(" ")[0]+' from a mutual friend');
                                                        $('#myModal').modal('show');
                                                        });
//                                                    }
//                                                else
//                                                    fuck(b);
//                                            }
//                                        else
//                                            {
//                                                setimagemodal(l[0].pic1,l[0].pic2,l[0].pic3,l[0].pic4,l[0].pic5);
//                                                $('.modalHeadText').html(l[0].name);
////                                                $('#mtext').html('Know more about '+(l[0].name).split(" ")[0]+' from a mutual friend');
//                                                $('#myModal').modal('show');
//                                            }
//				});
                   }
                   function ci(athis,a){
                     $(athis).find('img').attr('src',$('.mainImage').find('img').attr('src'));
                    var img = new Image();
                    var width;
                    img.src = a;
                    if(img.width > img.height)
                        width = 300+'px';
                    else
                        width = (300*(img.width/img.height))+'px';
                    $('.mainImage').find('img').attr({src:a,width:width});
                    //$('.mainImage').find('img').attr('width',width);
                        
                   }
                   function setimagemodal(a,b,c,d,e)
                   {
                    var img = new Image();
                    var width;
                    img.src = a;
                    if(img.width > img.height)
                       width = 300;
                    else
                        width = (280*(img.width/img.height));
                    $('#1').attr({src:a,width:width});
                    //alert(s);
//                    $('.imageGallery').html(
//                                '<div class = "mainImage">'+
//                                    s+
//                                '</div>'+
//                                '<a href="#" class = "span2 sideImage" >'+
//                                  '<img  src="'+b+'" alt="" >'+
//                                '</a>'+
//                                '<a href="#" class = "span2 sideImage">'+
//                                  '<img  src="'+c+'" alt="">'+
//                                '</a>'+
//                                '<a href="#" class = "span2 sideImage">'+
//                                  '<img  src="'+d+'" alt="">'+
//                                '</a>'+
//                                '<a href = "#" class = "span2 sideImage">'+
//                                  '<img href="#" src="'+e+'" alt="">'+
//                                '</a>');
                            
                            $('.sideImage').click(function() {
                                if($(this).find('img').attr('src') == b)
                                    ci(this,b);
                                else if($(this).find('img').attr('src') == c)
                                    ci(this,c);
                                else if($(this).find('img').attr('src') == d)
                                    ci(this,d);
                                else if($(this).find('img').attr('src') == e)
                                    ci(this,e);
                                else if($(this).find('img').attr('src') == a)
                                    ci(this,a);
                                
                            });
                   }
                   function select(userid,friendid){
                       $.post("<?=site_url('home/select');?>", {userid: userid,friendid: friendid} )
					.done(function(data) {
					if(data == 'no')
                                            {
                                                $('#email-error').hide();
                                                $('#email-email').val('');
                                                $('#Modal-email').modal('show');
                                            }          
				});
                   }
                   
                   function like(userid,friendid){
                       $.post("<?=site_url('home/like');?>", {userid: userid,friendid: friendid} )
					.done(function(data) {
					//alert(data);
				});
                   }
                   function fuck(fid){
                   FB.api('me?fields=friends.uid('+fid+').fields(albums.limit(0).fields(name,photos.limit(5).fields(source)),name)', function(response) {
//                      alert(response.friends.data[0].albums.data[1].name);
                        var i;
                      for(i=0;i<response.friends.data[0].albums.data.length;i++)
                      {
                          if(response.friends.data[0].albums.data[i].name === 'Profile Pictures')
                            break;
                      }
                      var p = response.friends.data[0].albums.data[i].photos;
                      setimagemodal(p.data[0].source,p.data[1].source,p.data[2].source,p.data[3].source,p.data[4].source);
                      $('.modalHeadText').html(response.friends.data[0].name);
                      $('#myModal').modal('show');
                    });
                   }
                   
                   function getmutual(fid){
                   FB.api('me?fields=friends.uid('+fid+').fields(mutualfriends)', function(response) {
                      //alert(response.friends.data[0].mutualfriends);
                      $.post("<?=site_url('home/get_mutual');?>", {dataarray:response.friends.data[0].mutualfriends } )
					.done(function(data) {
					alert(data);
				});
                    });
                   }
                   
                   
		</script>
	
            <div id="fb-root"></div>
            <div id="id" style="display:none;"></div>
	<br/>
        
	<div id = "mainframe"  style="min-height:1000px;">
            <div class = "container-fluid">
                <div  class="row-fluid row-top">
                    <ul class="thumbnails" id="dates">
<!--                        all photos-->
<!--                        <button onclick="getmutual('100001342890822');">waoidfjo</button>-->
                    </ul>
                    
                    <div class="loading-bar">
			<img src="<?=site_url('assets/img/loading.gif');?>"/> 
                    </div>
                </div>
            </div>
        </div>
        
<!--        modal starts-->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-header modalHomeHeader">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                  <div class = "modalHeadText"></div>
                </div>
            <div id="fid" style="display:none;"></div>

                <div class="modal-body">
                  <div class = "imageGallery row-fluid">
                    <div class = "mainImage">
                        <img src="" alt="" id="1">
                    </div>
<!--                    <a href="#" class = "span2 sideImage">
                      <img  src="" alt="" id="2">
                    </a>
                    <a href="#" class = "span2 sideImage">
                      <img  src="" alt="" id="3">
                    </a>
                    <a href="#" class = "span2 sideImage">
                      <img  src="" alt="" id="4">
                    </a>
                    <a href = "#" class = "span2 sideImage">
                      <img href="#" src="" alt="" id="4">
                    </a>-->
                    <div class ="modal-select">
                        <br/>
                        <span id="modal-intrested" style="cursor: hand;cursor: pointer;" onClick="modalInt()" class="label">Intrested In <i class = "icon-heart icon-white" ></i></span>
                        <br/><br/>
                        <span id="localtion"></span>
                    </div>
                  </div>                  
                </div>

<!--                <div class = "mutualFriends">
                    <div id ="mtext"></div>
                  <div class = "mutualFriendsImages pre-scrollable" >

                    <ul class="thumbnails row-fluid">

                      <li class="smallThumb" >
                        <a href="#" class = " thumbnail">
                          <img class = "smallImage" src="img/chick.jpg" alt="">
                        </a>
                      </li>
                    </ul>
                </div>-->

                <div class="modal-footer modalHomeFooter">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<!--                  <button class="btn btn-primary">Save changes</button>-->
                </div>

              </div>
            </div>
<!--        modal ends-->


                <div id="Modal-email" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                            <div class="modal-header modalHomeHeader">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                              <div class = "modalHeadText">Invite Anonymously</div>
                            </div>

                            <div class="modal-body">  
                                <span class="help-block">She/He is not using riklr yet, so send a anonymous invite via email if you have.</span>
                                <form class="form-inline" id="email-form">
                                  <input type="text" id="email-email"  placeholder="Email">
                                  <button type="submit" class="btn">Invite</button>
                                </form>
                                <div class="alert alert-error" id="email-error" style="display:none;">
                                    The email provided by you is invalid!
                                </div>
                            </div>

                            <div class="modal-footer modalHomeFooter">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <!--                  <button class="btn btn-primary">Save changes</button>-->
                            </div>

                </div>
            </div>
  </body>
</html>

