<!DOCTYPE html>
<html>
	<head>
		<title>Speech to text converter in JS</title>
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" />
		<style type="text/css">
			body{
				font-family: verdana;
			}
			#result{
				height: 25px;
				width: 200px;
				border: 1px solid #ccc;
				padding: 10px;
				box-shadow: 0 0 10px 0 #bbb;
				margin-left: 40%;
				font-size: 14px;
				line-height: 25px;
			}
			button{
				font-size: 20px;
				position: absolute;
				float: left;
			}
		</style>
	</head>
	<body>
		<div id="result">
					<button onclick = "startConverting();"><i class="fa fa-microphone"></i></button>

		</div>

		<script type="text/javascript">

			var r = document.getElementById('result');

			function startConverting () {
				if('webkitSpeechRecognition' in window){
					var msg = new SpeechSynthesisUtterance('Say Go to login to go to user login page');
								window.speechSynthesis.speak(msg);
					var speechRecognizer = new webkitSpeechRecognition();
					speechRecognizer.continuous = true;
					speechRecognizer.interimResults = true;
					speechRecognizer.lang = 'en-IN';
					speechRecognizer.start();

					var finalTranscripts = '';

					speechRecognizer.onresult = function(event){
						var interimTranscripts = '';
						for(var i = event.resultIndex; i < event.results.length; i++){
							var transcript = event.results[i][0].transcript;
							transcript.replace("\n", "<br>");
							if(event.results[i].isFinal){
								finalTranscripts += transcript;
								if (finalTranscripts.includes('home'))
								{
									window.location.replace("http://localhost/hospital/index.php");
								}
								if(finalTranscripts.includes('login'))
								{
									window.location.replace("http://localhost/hospital/hms/user-login.php");
								}
								if(finalTranscripts.includes('create') || finalTranscripts.includes('account'))
								{
									window.location.replace("http://localhost/hospital/hms/registration.php");
								}
								
							}
							else{
								interimTranscripts += transcript;
							}
						}
						r.innerHTML = finalTranscripts + '<span style="color:#999">' + interimTranscripts + '</span>';
					};
					speechRecognizer.onerror = function (event) {
					};
				}else{
					r.innerHTML = 'Your browser is not supported. If google chrome, please upgrade!';
				}
			}

			

		</script>
	</body>
</html>