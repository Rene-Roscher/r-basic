<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

/**
 * Class Account
 * @package App\Models
 * @property null|integer id
 * @property null|int user_id
 * @property null|integer ip_address
 * @property null|integer user_agent
 * @property null|string payload
 */
class Session extends Model
{
    private $agent;

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'user_id', 'ip_address', 'user_agent', 'payload'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payload()
    {
        return unserialize(base64_decode($this->payload));
    }

    public function uri()
    {
        if (!isset($this->payload()['_previous']['url']))
            return '-/-';
        return $this->payload()['_previous']['url'];
    }

    public function lastActivity()
    {
        return date('d.m.Y H:i:s', $this->last_activity);
    }

    public function os()
    {
        if ($this->agent)
            return $this->agent->platform();
        $this->agent = new Agent(null, $this->user_agent);
        return $this->agent->platform();
    }

    public function browser()
    {
        if ($this->agent)
            return $this->agent->browser();
        $this->agent = new Agent(null, $this->user_agent);
        return $this->agent->browser();
    }



}
