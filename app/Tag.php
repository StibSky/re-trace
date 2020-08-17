<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Tag extends Model
{
    private $id;
    public $timestamps = false;
    protected $table = "tags";

    /**
     * @return mixed
     */
    public function getMaterialId()
    {
        return $this->material_id;
    }

    /**
     * @param mixed $material_id
     */
    public function setMaterialId($material_id): void
    {
        $this->material_id = $material_id;
    }

    /**
     * @return mixed
     */
    public function getFunctionId()
    {
        return $this->function_id;
    }

    /**
     * @param mixed $function_id
     */
    public function setFunctionId($function_id): void
    {
        $this->function_id = $function_id;
    }

    /**
     * @return mixed
     */
    public function getStreamId()
    {
        return $this->stream_id;
    }

    /**
     * @param mixed $stream_id
     */
    public function setStreamId($stream_id): void
    {
        $this->stream_id = $stream_id;
    }

    protected $fillable = [
        'material_id', 'function_id', 'stream_id'
    ];

    public function Substance()
    {
        return $this->hasMany('App\Substance');
    }

    public function MaterialFunction()
    {
        return $this->hasMany('App\MaterialFunction');
    }

    public function Stream()
    {
        return $this->hasMany('App\Stream');
    }
}

