<?php

class Partner extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $description;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $nIP;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $webiste;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $dATE;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field nIP
     *
     * @param integer $nIP
     * @return $this
     */
    public function setNIP($nIP)
    {
        $this->nIP = $nIP;

        return $this;
    }

    /**
     * Method to set the value of field webiste
     *
     * @param string $webiste
     * @return $this
     */
    public function setWebiste($webiste)
    {
        $this->webiste = $webiste;

        return $this;
    }

    /**
     * Method to set the value of field dATE
     *
     * @param string $dATE
     * @return $this
     */
    public function setDATE($dATE)
    {
        $this->dATE = $dATE;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field nIP
     *
     * @return integer
     */
    public function getNIP()
    {
        return $this->nIP;
    }

    /**
     * Returns the value of field webiste
     *
     * @return string
     */
    public function getWebiste()
    {
        return $this->webiste;
    }

    /**
     * Returns the value of field dATE
     *
     * @return string
     */
    public function getDATE()
    {
        return $this->dATE;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("CRUD");
        $this->setSource("partner");
        $this->hasMany('id', 'Product', 'partner_id', ['alias' => 'Product']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Partner[]|Partner|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Partner|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'partner';
    }

}
