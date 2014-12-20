<?php

class State extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $state_id;

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

    /**
     *
     * @var string
     */
    public $name_short;

    /**
     *
     * @var integer
     */
    public $persistent;

    /**
     *
     * @var string
     */
    public $description;

}
