<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public $timestamps = false;

    protected $table = "building";

    protected $fillable = [
        'address1', 'address2','city', 'postcode', 'measuringState', 'materialList', 'surface',
        'image', 'plan'
    ];

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1): void
    {
        $this->address1 = $address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode): void
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getMeasuringState()
    {
        return $this->measuringState;
    }

    /**
     * @param mixed $measuringState
     */
    public function setMeasuringState($measuringState): void
    {
        $this->measuringState = $measuringState;
    }

    /**
     * @return mixed
     */
    public function getMaterialList()
    {
        return $this->materialList;
    }

    /**
     * @param mixed $materialList
     */
    public function setMaterialList($materialList): void
    {
        $this->materialList = $materialList;
    }

    /**
     * @return mixed
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param mixed $surface
     */
    public function setSurface($surface): void
    {
        $this->surface = $surface;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @param mixed $plan
     */
    public function setPlan($plan): void
    {
        $this->plan = $plan;
    }

}
