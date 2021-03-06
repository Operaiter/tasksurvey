<?php

class PartnerUnit extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $unit_id;

    /**
     *
     * @var integer
     */
    public $partner_id;

    /**
     *
     * @var string
     */
    public $name;

	public function initialize()
	{
		$this->belongsTo('partner_id', 'Partner', 'partner_id');
	}

}
