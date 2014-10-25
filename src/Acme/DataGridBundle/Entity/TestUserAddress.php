<?php

namespace Acme\DataGridBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sample entity used for testing only
 *
 * @ORM\Entity
 * @ORM\Table(name="test_user_address")
 */
class TestUserAddress
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $shortName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address_1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $address_2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $suburb;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $postcode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set shortName
     *
     * @param string $shortName
     * @return TestUserAddress
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set address_1
     *
     * @param string $address1
     * @return TestUserAddress
     */
    public function setAddress1($address1)
    {
        $this->address_1 = $address1;

        return $this;
    }

    /**
     * Get address_1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address_1;
    }

    /**
     * Set address_2
     *
     * @param string $address2
     * @return TestUserAddress
     */
    public function setAddress2($address2)
    {
        $this->address_2 = $address2;

        return $this;
    }

    /**
     * Get address_2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * Set suburb
     *
     * @param string $suburb
     * @return TestUserAddress
     */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
     * Get suburb
     *
     * @return string 
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return TestUserAddress
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return TestUserAddress
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }
}
