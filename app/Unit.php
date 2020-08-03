<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    /*
    * image class with getters and setters for properties
    * foreign keys to substance
    */
    private $id;
    public $timestamps = false;
    protected $table = "unit";


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
    public function getNameNl()
    {
        return $this->name_nl;
    }

    /**
     * @param mixed $name_nl
     */
    public function setNameNl($name_nl): void
    {
        $this->name_nl = $name_nl;
    }

    /**
     * @return mixed
     */
    public function getNameFr()
    {
        return $this->name_fr;
    }

    /**
     * @param mixed $name_fr
     */
    public function setNameFr($name_fr): void
    {
        $this->name_fr = $name_fr;
    }

    /**
     * @return mixed
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * @param mixed $short_name
     */
    public function setShortName($short_name): void
    {
        $this->short_name = $short_name;
    }

    /**
     * @return mixed
     */
    public function getShortNameNl()
    {
        return $this->short_name_nl;
    }

    /**
     * @param mixed $short_name_nl
     */
    public function setShortNameNl($short_name_nl): void
    {
        $this->short_name_nl = $short_name_nl;
    }

    /**
     * @return mixed
     */
    public function getShortNameFr()
    {
        return $this->short_name_fr;
    }

    /**
     * @param mixed $short_name_fr
     */
    public function setShortNameFr($short_name_fr): void
    {
        $this->short_name_fr = $short_name_fr;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }
    private $created_at;
    private $updated_at;

    protected $fillable = [
        'name', 'name_nl', 'name_fr', 'short_name', 'short_name_nl', 'short_name_fr', 'created_at',
        'updated_at'
    ];

    public function Substance()
    {
        return $this->hasMany('App\Unit');
    }
}
