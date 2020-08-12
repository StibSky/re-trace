<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialFunction extends Model
{
    private $id;
    public $timestamps = false;
    protected $table = "materialFunction";

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
        'name', 'name_nl', 'name_fr', 'parent', 'unit_id',
        'comments', 'created_at', 'updated_at'
    ];

    public function Unit()
    {
        return $this->belongsTo('App\MaterialFunction');
    }

    public function Materiallist()
    {
        return $this->belongsTo('App\MaterialFunction');
    }
}
