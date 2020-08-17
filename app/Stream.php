<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    private $id;
    public $timestamps = false;
    protected $table = "streams";

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBuildid()
    {
        return $this->buildid;
    }

    /**
     * @param mixed $buildid
     */
    public function setBuildid($buildid): void
    {
        $this->buildid = $buildid;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * @param mixed $unit_id
     */
    public function setUnitId($unit_id): void
    {
        $this->unit_id = $unit_id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getValutaId()
    {
        return $this->valuta_id;
    }

    /**
     * @param mixed $valuta_id
     */
    public function setValutaId($valuta_id): void
    {
        $this->valuta_id = $valuta_id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }



    protected $fillable = [
        'name', 'description', 'buildid', 'category', 'unit_id', 'quantity', 'valuta_id', 'price'
    ];

    public function Building() {
        return $this->belongsTo('App\Building');
    }
    public function Unit() {
        return $this->hasMany('App\Unit');
    }
    public function Valuta() {
        return $this->hasMany('App\Valuta');
    }
}
