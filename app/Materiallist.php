<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiallist extends Model
{
    private $id;

    /**
     * @return mixed
     */
    public function getSubstanceId()
    {
        return $this->substanceId;
    }

    /**
     * @param mixed $substanceId
     */
    public function setSubstanceId($substanceId): void
    {
        $this->substanceId = $substanceId;
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
        'buildid', 'material', 'created_at', 'updated_at', 'quantity', 'substanceId'
    ];

    public function Building()
    {
        return $this->belongsTo('App\Building');
    }

    public function Substance()
    {
        return $this->belongsTo('App\Substance');
    }

}
