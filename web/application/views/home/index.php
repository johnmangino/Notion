<!doctype html>  

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --> 
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!--  Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Place favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">


  <!-- CSS : implied media="all" -->
  <link rel="stylesheet" href="css/style.css?v=2">

  <!-- Uncomment if you are specifically targeting less enabled mobile browsers
  <link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->
 
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/libs/modernizr-1.6.min.js"></script>
  <?php
  
  ?>

</head>

<body>

  <div id="container">
    <header>
      
        <h1>Slim UI</h1>
        <div id="fb-root"></div>
        
        <?php
        
        $session = $this->facebook->getSession();
        if(!$session) {
          $login = $this->facebook->getLoginUrl(array('req_perms' => 'email,friends_photos'));
           echo anchor($login,'Login');
       } else {
         $logout = $this->facebook->getLogoutUrl();
         echo anchor($logout,'Logout'); 
         }
         $me = $this->facebook->api('/me');
         $accessToken = $session['access_token'];
         $uid = $this->facebook->getUser();
            print_r($session);
         ?>
         <h2>Greetings <?php echo $me['name'];  ?> <img src="https://graph.facebook.com/<?php echo $uid; ?>/picture" /></h2>
    </header>
    
    <div id="main">
     
     <?php 
     $req = $this->facebook->api('/me/friends',array('limit' => 5,'offset' => 5)); 
     ?>
      <pre>
      <?php print_r($req['data']); ?>
      </pre>
      <!-- List pictures of friends -->
      <?php foreach($req['data'] as $friend): ?>
        <div class='fbFriends'>
          <?php 
          $albums = $this->facebook->api($friend['id']. "/albums", array('access_token' => $accessToken)); 
          ?>
          <pre>
            <?php //print_r($albums); ?>
          </pre>
          <h1>*********************************************************************************************</h1>
          <?php foreach($albums['data'] as $al) {
                       if($al['name'] == 'Profile Pictures') {
                         $wall = $al['id'];
                         echo $wall;
            }
          } ?>
          <h1>~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~</h1>
          <img src="https://graph.facebook.com/<?php echo $friend['id']; ?>/picture" /><a href="https://graph.facebook.com/<?php echo $friend['id']; ?>/albums?access_token=<?=$accessToken ?>"><h2><?php echo $friend['name']; ?></h2></a>
        </div>
      <?php endforeach; ?>
      <hr />
      
      <!-- grab the uid to grab the album id -->
      <?php
      $joey = $req['data'][3]['id'];
      $x = $this->facebook->api('/' .$joey. '/albums');
      ?>
      <pre>
        <?php print_r($x['data']); ?>
      </pre>
      <div>
        <?php foreach($x['data'] as $album): ?>
          <h3><a href="<?php echo $album['link']; ?>"><?php echo $album['name']; ?></a></h3>
        <?php endforeach; ?>
        
        
        <!-- http://www.facebook.com/album.php?aid=2165029&id=25515241 -->
      </div>
    </div>
    
    <footer>

    </footer>
  </div> <!--! end of #container -->


  <!-- Javascript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>
  
  
  <!-- scripts concatenated and minified via ant build script-->
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <!-- end concatenated and minified scripts-->
  
  
  <!--[if lt IE 7 ]>
    <script src="js/libs/dd_belatedpng.js"></script>
    <script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
  <![endif]-->

  <!-- yui profiler and profileviewer - remove for production -->
  <script src="js/profiling/yahoo-profiling.min.js"></script>
  <script src="js/profiling/config.js"></script>
  <!-- end profiling code -->


  <!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet 
       change the UA-XXXXX-X to be your site's ID -->
  <script>
   // var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
   //    (function(d, t) {
   //     var g = d.createElement(t),
   //         s = d.getElementsByTagName(t)[0];
   //     g.async = true;
   //     g.src = ('https:' == location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
   //     s.parentNode.insertBefore(g, s);
   //    })(document, 'script');
  </script>
  
      <script src="http://connect.facebook.net/en_US/all.js"></script>
      <script>
        FB.init({appId: '<?=$appId; ?>', status: true,
                 cookie: true, xfbml: true});
        FB.Event.subscribe('auth.login', function(response) {
          window.location.reload();
        });
      </script>
 
</body>
</html>