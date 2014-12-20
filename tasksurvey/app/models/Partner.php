<?php

class Partner extends \Phalcon\Mvc\Model
{

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
		$this->hasMany('partner_id', 'PartnerUnit', 'partner_id');
	}

}
