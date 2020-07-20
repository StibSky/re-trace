<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /*
    * image class with getters and setters for properties
    * foreign key to building
    */

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
    private $id;
    public $timestamps = false;
    protected $table = "image";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'created_at', 'updated_at', 'buildid'
    ];

    public function Building()
    {
        return $this->belongsTo('App\Building');
    }
}
