<!DOCTYPE html>
<html>
  <head>
    <title>Instascan</title>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  </head>
  <body>
    <video id="preview"></video>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {

        let params = new URLSearchParams(location.search);
        stu = params.get('stu');
        //console.log(content);
        //console.log(stu);
        $.post("postqr.php",{
          content,stu
        },function(data) {
          alert(data);
          //console.log("แสดงค่าตัวแปร -> "+data);
        });
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    </script>
  </body>
</html>
