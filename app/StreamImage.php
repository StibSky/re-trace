<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StreamImage extends Model
{
    private $id;

    public $timestamps = false;
    protected $table = "stream_images";

    protected $fillable = [
        'name', 'created_at', 'updated_at', 'streamId'
    ];

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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getStreamId()
    {
        return $this->streamId;
    }

    /**
     * @param mixed $streamId
     */
    public function setStreamId($streamId): void
    {
        $this->streamId = $streamId;
    }

    public function Stream()
    {
        return $this->belongsTo('App\Stream');
    }
}
