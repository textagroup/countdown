<?php

class CountdownWidgetExtension extends DataExtension {

	private static $db = array(
		'EndDate' => 'Datetime',
		'CountdownType' => 'Varchar'
	);

	private $options = array(
		'CouponDays' => array (
			'Template' => 'CountdownDiv',
			'Script' => 'countdown-coupon-days'
		),
		'CouponWeeks' => array (
			'Template' => 'CountdownSpan',
			'Script' => 'countdown-coupon-weeks'
		),
		'Legacy' => array (
			'Template' => 'CountdownDiv',
			'Script' => 'countdown-legacy'
		)
	);

	public function updateCMSFields(FieldList $fields) {
		$countdownTypes = array();
		foreach ($this->options as $key => $value) {
			$countdownTypes[$key] = $key;
		}
		$fields->addFieldsToTab('Root.Countdown',
			array(
				DateField::create('EndDate', 'EndDate')
					->setConfig('showcalendar', true),
				DropdownField::create('CountdownType', 'CountdownType',$countdownTypes)
			)
		);
	}

	public function jsScripts() {
		Requirements::javascript('framework/thirdparty/jquery/jquery.js');
		Requirements::javascript('countdown/thirdparty/jQuery.countdown/dist/jquery.countdown.js');
	}

	public function formattedEndDate() {
		$timezoneDate = date('Y-m-d H:i:s T', strtotime($this->owner->EndDate));
		return gmdate(DATE_RFC822, strtotime($timezoneDate));
	}

	public function Countdown() {
		$this->jsScripts();
		$formatDate = $this->formattedEndDate();
		$vars = array(
			'EndDate' => $formatDate
		);
		$script = $this->options[$this->owner->CountdownType]['Script'];
		$template = $this->options[$this->owner->CountdownType]['Template'];
		Requirements::javascriptTemplate("countdown/js/$script.js", $vars);
		return $this->owner->renderWith($template);
	}
}
