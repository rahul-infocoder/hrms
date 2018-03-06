
	
		<?php 
		$time_allowed = 0;
		 //print_r($this->session->all_userdata());exit;
		if($this->session->userdata('time_allowed')){
		$time_allowed = $this->session->userdata('time_allowed');
		//print_r($time_allowed);exit;
		}
		if (!$this->session->userdata('endOfTimer')){
		$endOfTimer = time() + $time_allowed;
		$this->session->set_userdata('endOfTimer',$endOfTimer);

		}
		 
		if(($this->session->userdata('endOfTimer') - time()) < 0) {
		$timeTilEnd = 0;
		}else{
		$timeTilEnd = $this->session->userdata('endOfTimer') - time();
		}
		 
		function secondsToWords($seconds){
		$ret = "";
		/*** get the hours ***/
		$hours = intval(intval($seconds) / 3600);
		if($hours > 0){
		$ret .= "$hours:";
		echo $ret;
		}
		/*** get the minutes ***/
		$minutes = bcmod((intval($seconds) / 60),60);
		if($hours > 0 || $minutes > 0){
		$ret .= "$minutes:";
		}
		/*** get the seconds ***/
		$seconds = bcmod(intval($seconds),60);
		if($seconds < 10){
		$ret .= "0"."$seconds";
		}else{
		$ret .= "$seconds";
		}
		return $ret;
		}
		?>
		 <span id="timer"><?php return secondsToWords($timeTilEnd); ?></span>

    <script type="text/javascript">
	
		var TimeLeft = '<?php echo $timeTilEnd; ?>';
		TimeLeft = Number(TimeLeft);
		function countdown(){
		if(Number(TimeLeft) > 0) {
		TimeLeft -= 1;
		document.getElementById('timer').innerHTML = seconds2time(TimeLeft);
		}else{
		if(Number(TimeLeft) == 0){
		clearInterval(CountFunc);
		return false;
		}
		}
		}
		 
		var CountFunc = setInterval(countdown,1000);
		 
		function seconds2time (seconds) {
		var hours   = Math.floor(seconds / 3600);
		var minutes = Math.floor((seconds - (hours * 3600)) / 60);
		var seconds = seconds - (hours * 3600) - (minutes * 60);
		var time = "";
		 
		if (hours != 0) {
		time = hours+":";
		}
		if (minutes != 0 || time !== "") {
		minutes = (minutes < 10 && time !== "") ? "0"+minutes : String(minutes);
		time += minutes+":";
		}
		if (time === "") {
		time = seconds+"s";
		}else {
		time += (seconds < 10) ? "0"+seconds : String(seconds);
		}
		return time;
		}
	</script>
    