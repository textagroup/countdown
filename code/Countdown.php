<?php

class CountdownWidgetExtension extends DataExtension {

	private static $db = array(
		'EndDate' => 'Datetime'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->push(
			DateField::create('EndDate', 'EndDate')
				->setConfig('showcalendar', true)
		);
	}

	public function Countdown() {
		Requirements::javascript('framework/thirdparty/jquery/jquery.js');
		Requirements::javascript('countdown/thirdparty/jquery.countdown/dist/jquery.countdown.js');
		$timezoneDate = date('Y-m-d H:i:s T', strtotime($this->owner->EndDate));
		$formatDate = gmdate(DATE_RFC822, strtotime($timezoneDate));
		$vars = array(
			'EndDate' => $formatDate
		);
		Requirements::javascriptTemplate('countdown/js/countdown.js', $vars);
		return $this->owner->renderWith('CountdownWidget');
	}
}
