<?php

class CountdownWidgetExtension extends DataExtension
{

    private static $db = array(
        'EndDate' => 'Datetime',
        'CountdownType' => 'Varchar',
        'CountdownElementID' => 'Varchar',
        'CountdownElementClass' => 'Varchar'
    );

    private static $defaults = array(
        'CountdownElementID' => 'clock',
        'CountdownElementClass' => 'CountdownClock'
    );

    private $options = array(
        'DaysOnly' => array(
            'Template' => 'CountdownDiv',
            'Script' => 'countdown-days-only'
        ),
        'CouponDays' => array(
            'Template' => 'CountdownDiv',
            'Script' => 'countdown-coupon-days'
        ),
        'CouponWeeks' => array(
            'Template' => 'CountdownSpan',
            'Script' => 'countdown-coupon-weeks'
        ),
        'Legacy' => array(
            'Template' => 'CountdownDiv',
            'Script' => 'countdown-legacy'
        )
    );

    public function updateCMSFields(FieldList $fields)
    {
        $countdownTypes = array();
        foreach ($this->options as $key => $value) {
            $countdownTypes[$key] = $key;
        }
        $fields->addFieldsToTab('Root.Countdown',
            array(
                DateField::create('EndDate', 'EndDate')
                    ->setConfig('showcalendar', true),
                DropdownField::create('CountdownType', 'CountdownType', $countdownTypes)
                    ->setEmptyString('Select one'),
                TextField::create('CountdownElementID'),
                TextField::create('CountdownElementClass')
            )
        );
    }

    public function jsScripts()
    {
        Requirements::javascript('framework/thirdparty/jquery/jquery.js');
        Requirements::javascript('countdown/thirdparty/jQuery.countdown/dist/jquery.countdown.js');
    }

    public function formattedEndDate()
    {
        return gmdate(DATE_W3C, strtotime($this->owner->EndDate));
    }

    public function HasEnded()
    {
        if (!$this->owner->EndDate || !$this->owner->CountdownType) {
            return false;
        }

        return $this->owner->dbObject('EndDate')->InPast();
    }

    public function Countdown()
    {
        if (!$this->owner->EndDate || !$this->owner->CountdownType) {
            return;
        }
        $this->jsScripts();
        $formatDate = $this->formattedEndDate();
        $vars = array(
            'EndDate' => $formatDate,
            'ElementClass' => $this->owner->CountdownElementClass,
            'ElementID' => $this->owner->CountdownElementID
        );
        $script = $this->options[$this->owner->CountdownType]['Script'];
        $template = $this->options[$this->owner->CountdownType]['Template'];
        Requirements::javascriptTemplate("countdown/js/$script.js", $vars, true);
        return $this->owner->renderWith($template);
    }
}
