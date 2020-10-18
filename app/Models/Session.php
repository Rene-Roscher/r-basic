<?php

namespace RServices\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use RServices\Helpers\Button\ButtonBuilder;
use RServices\Helpers\Crud\FormContract;

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

    use FormContract;

    public static $formFields = [
        'name:user_id|type:text',
        'name:ip_address|type:text',
        'name:payload|type:text',
        'name:user_id|type:multiSelect|relation:user,name|col:4|only:update',
    ];

    public static $dataTablesFields = [
        'id' => 'ID',
        'user_id' => 'User',
        'ip_address' => 'IP-Address',
    ];

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

    public static function columnAction($entry, $name)
    {
        return ButtonBuilder::create()->addDelete(\route(sprintf('%s.delete', $name), compact('entry')))->make();
    }

}
