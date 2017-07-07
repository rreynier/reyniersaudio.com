<?php
$model->getModel($conn,$modelId,1);
// Check if model is active or exists
if($model->id != '') {
    $site->addToTitle($model->title);
    $site->addToTitle(' - '. strip_tags($model->shortDesc). ' DAW Computer');
    $site->addCss('/css/model.css');
    $site->addJs('/js/builder.js');
    $site->addToMeta($model->title . " - ". $model->shortDesc . " Music Recording Computer: Configure your custom DAW workstation.  Customize your DAW for ProTools, Sonar, Cubase, Samplitude, Nuendo etc.  ");
    // Start Output buffer and collect html content //
    ob_start();
    include 'tasks/browse/views/html/model.html.php';
    // Set the Site Object content to what we just collected  with the output buffer //
    $site->setContent(ob_get_contents());
    ob_end_clean();
} else {
    //If model is not active or does not exists..
    header( 'Location: index.php' );
}
function printInputVars($partType,$subType,$part,$optionCost,$optionNumber,$optionText) {
	echo 'id="pt' . $part->id . 'st' . $subType->id . 'o' . $optionNumber . '" ';
	echo 'name="' . $subType->id . '" ';
	echo 'subTypeId="' . $subType->id . '" ';
	echo 'subTypeTitle="' . $subType->title . '" ';
	echo 'subTypeShortTitle="' . $subType->shortTitle . '" ';
	echo 'partId="' . $part->id . '" ';
	echo 'partTitle="' . $part->title;
	if ($optionText != '') { echo ' - ' . $optionText .'" '; }
	else { echo '" '; }
	echo 'partType="' . $partType->title . '" ';
	echo 'partTypeId="' .$partType->id . '" ';
	echo 'partTypeTitle="' .$partType->title . '" ';
	echo 'partTypeOrder="' .$partType->order . '" ';
	if ($optionCost == '') {
		echo 'cost="' . round(number_format($part->partCost * (1 + $part->profitPercent),2,'.','')) . '" ';
	}
	else {
		echo 'cost="' . round(number_format($optionCost * (1 + $part->profitPercent),2,'.','')). '" ';
	}
}

function printOptions($partType,$subType,$part,$defaultCost) {
	if ($part->option1Text != '') {
		echo '<br /><input type="radio" ';
		printInputVars($partType,$subType,$part,$part->option1Cost,1,$part->option1Text);
		echo 'upgradeCost=' . round(($part->option1Cost * (1 + $part->profitPercent) - $defaultCost)) . ' /><label for="pt' . $part->id . 'st' . $subType->id . 'o1" >' . $part->option1Text;
		echo ' Add $' . round(($part->option1Cost  * (1 + $part->profitPercent)- $defaultCost)) . '</label>';
	}
	if ($part->option2Text != '') {
		echo '<br /><input type="radio" ';
		printInputVars($partType,$subType,$part,$part->option2Cost,2,$part->option2Text);
		echo 'upgradeCost=' . round(($part->option2Cost * (1 + $part->profitPercent) - $defaultCost)) . ' /><label for="pt' . $part->id . 'st' . $subType->id . 'o2" >' . $part->option2Text;
		echo ' Add $' . round(($part->option2Cost * (1 + $part->profitPercent)- $defaultCost)) . '</label>';
	}
	if ($part->option3Text != '') {
		echo '<br /><input type="radio" ';
		printInputVars($partType,$subType,$part,$part->option3Cost,3,$part->option3Text);
		echo 'upgradeCost=' . round(($part->option3Cost * (1 + $part->profitPercent) - $defaultCost)) . ' /><label for="pt' . $part->id . 'st' . $subType->id . 'o3" >' . $part->option3Text;
		echo ' Add $' . round(($part->option3Cost * (1 + $part->profitPercent) - $defaultCost)) . '</label>';
	}
}

function printPartImage($conn,$part) {
	$part->getImages($conn);
	$imagePrinted = 0;
	foreach($part->images as $image) {
		if($image->order == 1 && $imagePrinted == 0 ) {
			echo '<img src="/images/parts/tn/' . $image->imageUrl . '" alt="' . $image->title . '" />';
			$imagePrinted = 1;
		}
	}
}

function printPartInput($partType,$subType,$part,$default,$defaultCost) {


	if ($subType->inputType != 'check') {
		echo '<input type="radio" ';
	} else {
		echo '<input type="checkbox" ';
	}
	printInputVars($partType,$subType,$part,'','','');
	// If input is an option
	if ($option == 1) {

	}
	else {
		//If part is default part, add selected class
		if ($default == 1) {
			echo 'class="selected" ';
			echo 'upgradeCost="0" default="1" checked />';
			echo '<label for="pt' . $part->id . 'st' . $subType->id . 'o">Default Selection</label>';
		}
		else {
			echo 'upgradeCost="' . round(($part->getPrice() - $defaultCost)) . '" />';
			if ($subType->inputType == 'check') {
				/*echo '<label for="pt' . $part->id . 'st' . $subType->id . 'o">' . 'Add $' . number_format($part->getPrice()) . '</label>';*/
				echo '<label for="pt' . $part->id . 'st' . $subType->id . 'o">' . 'Add $' . $part->getPrice() . '</label>';
			}
			else {
				$upgradeCost = round($part->getPrice() - $defaultCost);
				/*echo '<label for="pt' . $part->id . 'st' . $subType->id . 'o">' . getVerbage($upgradeCost) . number_format(abs($upgradeCost)). '</label>';*/
				echo '<label for="pt' . $part->id . 'st' . $subType->id . 'o">' . getVerbage($upgradeCost) . abs($upgradeCost). '</label>';
			}
		}
	}
}

function getVerbage($amount) {
	if ($amount >= 0) {
		return 'Add $';
	}
	if ($amount < 0) {
		return 'Subtract $';
	}
}

function buildRightBar($model,$partType,$subType,$part,$conn) {
	$model->getPartTypes($conn);
	foreach((array)$model->partTypes as $partType)  {
		$partType->getSubTypes($conn);
		echo $partType->title;
		foreach((array)$partType->subTypes as $subType) {
			echo $subType->title;
		}
	}
}


