<?php
$configx = explode("#", configx());
$bgx = explode("#", bgx());
?>
<style>
.login-form .login-type {
	display:none;
}
.login-form .login-type.active {
	display:block;
}
</style>
<script src="<?php echo base_url();?>assets/facelogin/face-api.min.js"></script>
<form action="" method="post">
	<div class="panel panel-body login-form">
		<div class="text-center">
			<div class="icon-object border-slate-300 text-slate-300"><img src="<?php echo base_url('assets/images/logo/'.$bgx[2]);?>" alt="<?php echo $configx[0];?>" width="80"></div>
			<h5 class="content-group"><?php echo $configx[0];?></h5>
			<?php
			echo $this->session->flashdata('msg');
			?>
			
		</div>
		
		<div class="login-toggle text-center">
			<button type="button" class="account btn btn-success">Account Login</button> <button type="button" class="facelogin btn btn-default">Face Login</button>
		</div>
		<br />
		
		<div id="login-account" class="login-type active">

			<div class="form-group has-feedback has-feedback-left">
				<input type="text" class="form-control" name="nip" placeholder="nip" required>
				<div class="form-control-feedback">
					<i class="icon-user text-muted"></i>
				</div>
			</div>

			<div class="form-group has-feedback has-feedback-left">
				<input type="password" class="form-control" name="password" placeholder="Password" required>
				<div class="form-control-feedback">
					<i class="icon-lock2 text-muted"></i>
				</div>
			</div>
			
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="form-group">
						<button type="submit" name="btnlogin" class="btn btn-primary btn-block btnlogin">Login <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		
		</div>
		
		<div id="login-facelogin" class="login-type">
			
	
			  <div class="margin" style="position: relative; border: 3px solid #42a5f5 !important;">
				<video id="vidDisplay" style="height: 255px; width: 275px; display: inline-block; vertical-align: baseline;" onloadedmetadata="onPlay(this)" autoplay="true"></video>
				<canvas id="overlay" style="position: absolute; top: 0; left: 0;" width = "275" height = "255"/>
			  </div>

		
		</div>
		
		

	
	</div>
</form>
					
<script>
$(document).ready(function(){
  $("button.account").click(function(){
		$("button.account").addClass("btn-success").removeClass("btn-default");
		$("button.facelogin").removeClass("btn-success");
		$("#login-facelogin").removeClass("active");
		$("#login-account").addClass("active");
  });
   $("button.facelogin").click(function(){
		$("button.facelogin").addClass("btn-success").removeClass("btn-default");
		$("button.account").removeClass("btn-success");
		$("#login-facelogin").addClass("active");
		$("#login-account").removeClass("active");
  });
});
</script>
				
<script>
  var waitingDialog = waitingDialog || (function ($) {
    var $dialog = $(
      '<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
        '<div class="modal-dialog modal-m">' +
          '<div class="modal-content">' +
          '<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
          '<div class="modal-body">' +
            '<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
          '</div>' +
      '</div></div></div>');

  return {
    show: function (message, options) {
      if (typeof options === 'undefined') {
        options = {};
      }
      if (typeof message === 'undefined') {
        message = 'Loading';
      }
      var settings = $.extend({
        dialogSize: 'm',
        progressType: '',
        onHide: null 
      }, options);
      $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
      $dialog.find('.progress-bar').attr('class', 'progress-bar');
      if (settings.progressType) {
        $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
      }
      $dialog.find('h3').text(message);
      if (typeof settings.onHide === 'function') {
        $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
          settings.onHide.call($dialog);
        });
      }
      $dialog.modal();
    },
    hide: function () {
      $dialog.modal('hide');
    }
  };

})(jQuery);
</script>


<script>

  //----------------------------GLOBAL VARIABLE FOR FACE MATCHER------------------------------------
  var faceMatcher = undefined
  //----------------------------------------------------------------------------------------------

  //waitingDialog.show('Initializing data....', {dialogSize: 'sm', progressType: 'success'})
  $("#facelogin").hide();
  Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('<?php echo base_url();?>assets/facelogin/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('<?php echo base_url();?>assets/facelogin/models'),
	//faceapi.nets.mtcnn.loadFromUri('<?php echo base_url();?>assets/facelogin/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('<?php echo base_url();?>assets/facelogin/models'),
    faceapi.nets.tinyFaceDetector.loadFromUri('<?php echo base_url();?>assets/facelogin/models')
  ]).then(start)

  async function start() {
    $.ajax({
        datatype: 'json',
		url: "<?php echo base_url()?>web/neural",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y])
              content.parent[x]._descriptors[y] = new Float32Array(results)
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        waitingDialog.hide()
        $('#facelogin').show()     
        run();
    });
  }

  // Create Face Matcher
  async function createFaceMatcher(data) {
    const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
      const descriptors = [];
      for (var i = 0; i < className._descriptors.length; i++) {
        descriptors.push(className._descriptors[i]);
      }
      return new faceapi.LabeledFaceDescriptors(className._label, descriptors);
    }))
    return new faceapi.FaceMatcher(labeledFaceDescriptors,0.6);
  }


  async function onPlay() {
      const videoEl = $('#vidDisplay').get(0)
      if(videoEl.paused || videoEl.ended )
        return setTimeout(() => onPlay())

        $("#overlay").show()
        const canvas = $('#overlay').get(0)
        
        if($("#register").hasClass('active'))
        {
          const options = getFaceDetectorOptions()
          const result = await faceapi.detectSingleFace(videoEl, options)
          if (result) {
            const dims = faceapi.matchDimensions(canvas, videoEl, true)
            dims.height = 255
            dims.width = 255
            canvas.height = 275
            canvas.width = 255
            const resizedResult = faceapi.resizeResults(result, dims)
            faceapi.draw.drawDetections(canvas, resizedResult)  
          }     
          else{
            $("#overlay").hide()
          } 
        }

        if($("#login-facelogin").hasClass('active'))
        {
          if(faceMatcher != undefined){
		  
            //--------------------------FACE RECOGNIZE------------------
			
            const input = document.getElementById('vidDisplay')
            const displaySize = { width: 275, height: 255 }
            faceapi.matchDimensions(canvas, displaySize)
            const detections = await faceapi.detectAllFaces(input).withFaceLandmarks().withFaceDescriptors()
            const resizedDetections = faceapi.resizeResults(detections, displaySize)
            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            results.forEach((result, i) => {
                const box = resizedDetections[i].detection.box
                const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
                drawBox.draw(canvas)
                var str = result.toString()
                rating = parseFloat(str.substring(str.indexOf('(') + 1,str.indexOf(')')))
                str = str.substring(0, str.indexOf('('))
                str = str.substring(0, str.length - 1)
                if(str != "unknown"){
					console.log("Match TRUE!");
					match = true;
					$.post( "<?php echo base_url();?>web/login", { facelogin: str} );
					alert('Face Login terkonfirmasi!');
					location.reload(); 
					event.preventDefault(); 
                }
            })
            //---------------------------------------------------------------------  
          }
        }

      setTimeout(() => onPlay())
    }

  async function run() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#vidDisplay').get(0)
      videoEl.srcObject = stream
  }
  
  // tiny_face_detector options
  let inputSize = 160
  let scoreThreshold = 0.4

  function getFaceDetectorOptions() {
    return  new faceapi.TinyFaceDetectorOptions({ inputSize, scoreThreshold });
  }

  async function load_neural(){
    waitingDialog.show('Initializing neural data....', {dialogSize: 'sm', progressType: 'success'})
    $.ajax({
        datatype: 'json',
		url: "<?php echo base_url()?>web/neural",
        data: ""
    }).done(async function(data) {
        if(data.length > 2){
          var json_str = "{\"parent\":" + data  + "}"
          content = JSON.parse(json_str)
          console.log(content)
          for (var x = 0; x < Object.keys(content.parent).length; x++) {
            for (var y = 0; y < Object.keys(content.parent[x]._descriptors).length; y++) {
              var results = Object.values(content.parent[x]._descriptors[y]);
              content.parent[x]._descriptors[y] = new Float32Array(results);
            }
          }
          faceMatcher = await createFaceMatcher(content);
        }
        waitingDialog.hide()
    });
  }
  

</script>
