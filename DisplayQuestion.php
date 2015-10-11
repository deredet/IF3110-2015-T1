<!DOCTYPE html>
<html>
	<head>
		<title>Simple Stack Exchange </title>
		<link rel="stylesheet" type="text/css" href="Style.css">
		<script type="text/javascript" src = "Validate.js"></script>
	</head>
	<body>
		<div class = "titlefont">
			<div class="textcentering">
				<h1>Simple Stack Exchange</h1><br>
			</div>
		</div>
		<?php
		include 'qDBFunct.php';
		include 'aDBFunct.php';
		$qid = $_GET['qid'];
		$Question = getQuestion($qid);
		$result = mysqli_fetch_array($Question,MYSQLI_ASSOC);
		echo '
		<div class = "titlefont">
			<div class ="h1style">
				<h1>'.$result['qTopic'].'</h1>
			</div><hr>
		</div>';
		echo '<br><div class="collection">
					<div class="compactbox">
						<div class="textcentering">
							<div class="votestyle">
								<h1>'.$result['qVote'].'</h1>
							</div>
						</div>
					</div>
					<div class="compactbox">
						<div class="topicstyle">
							 '.$result['qContent'].'
						</div>
					</div>
					<div class="choicebox">
						Asked by<a id=blue> '.$result['qName'].'</a> at '.$result['qDate'].' | <a id=orange href="QuestionForm.php?qid='.$qid.'">edit</a> | <a id=red href="DeleteQuestion.php?qid='.$qid.'" onclick ="return confirmDeletion('.$qid.')">delete</a> </div>
					</div>';
		$Answers = getAllAnswerOrderByVote($qid);
		$nAns =count($Answers)-1;

		echo '
			<div class = "titlefont">
				<div class ="h1style">
					<h1>'.$nAns.' Answers</h1>
				</div><hr>
			</div>
			';
		if($Answers!=null){
				foreach($Answers as $Answer){
					$aid=$Answer['aid'];
					echo '<br><div class="collection">
					<div class="compactbox">
						<div class="textcentering">
							<div class="votestyle">
								<h1>'.$Answer['aVote'].'</h1><h2>Vote</h2>
							</div>
						</div>
					</div>
					<div class="compactbox">
						<div class="topicstyle">
							<a id = black href="DisplayQuestion.php?qid='.$qid.'">'. $Answer['aContent'].'</a>
						</div>
					</div>
					<div class="choicebox">
						Answered by<a id=blue> '.$Answer['aName'].'</a> at '.$Answer['aDate'].'
					</div>';
				}
		}
		?>
		<div class = "titlefont">
				<div class ="h1style">
					<h1>Your Answer</h1>
				</div><hr>
			</div>
		<form name="aForm" action="SubmitAnswer.php?'" method="post" onsubmit="return validateAnswerForm()" >
			<div class="formpos">
				<input type="hidden" name="qid" value="<?php echo $qid ?>"/>
				<input type="text" name="name" placeholder="Nama" class="form-textfield"></input>
				<br>
				<input type="text" name="email" placeholder="Email" class="form-textfield"></input>
				<br>
				<textarea name="content" placeholder="Content" class="form-textarea"b></textarea></input>
				<br>
				<div class="searchstyle">
					<input type="submit" value="Submit">
				</div>
			</div>
		</form>
	</body>
</html> 