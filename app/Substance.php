<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Substance extends Model
{

    /*
    * substance class with getters and setters for properties
    * foreign keys to unit
    */
    private $id;
    public $timestamps = false;
    protected $table = "substance";

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
    public function getSpecificWeight()
    {
        return $this->specific_weight;
    }

    /**
     * @param mixed $specific_weight
     */
    public function setSpecificWeight($specific_weight): void
    {
        $this->specific_weight = $specific_weight;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code): void
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
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
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getIsHazardous()
    {
        return $this->is_hazardous;
    }

    /**
     * @param mixed $is_hazardous
     */
    public function setIsHazardous($is_hazardous): void
    {
        $this->is_hazardous = $is_hazardous;
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


    protected $fillable = [
        'name', 'name_nl', 'name_fr', 'specific_weight', 'code', 'parent', 'unit_id',
        'comments', 'is_hazardous', 'created_at', 'updated_at'
    ];

    public function Unit()
    {
        return $this->belongsTo('App\Substance');
    }

    public function Materiallist()
    {
        return $this->belongsTo('App\Substance');
    }
}
