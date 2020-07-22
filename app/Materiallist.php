<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiallist extends Model
{
    private $id;
    public $timestamps = false;
    protected $table = "materiallist";

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial($material): void
    {
        $this->material = $material;
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


    protected $fillable = [
        'buildid', 'material', 'created_at', 'updated_at'
    ];

    public function Building()
    {
        return $this->belongsTo('App\Building');
    }

}
