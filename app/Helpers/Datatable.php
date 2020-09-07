<?php


namespace RServices\Helpers;


class Datatable
{

    /**
     * @return Datatable
     */
    public static function create() {
        return new self();
    }

    private $columns;
    private $reload;

    public function __construct()
    {
        $this->columns = [];
    }

    /**
     * @param $data | key
     * @param bool $searchable
     * @param bool $orderable
     * @return $this
     */
    public function put($data, $searchable = true, $orderable = true)
    {
        $this->columns[] = get_defined_vars();
        return $this;
    }

    public function add(...$keys)
    {
        foreach ($keys as $key)
            $this->put($key);
        return $this;
    }

    public function addAction()
    {
        return $this->put('action', false, false);
    }

    public function get()
    {
        return json_encode($this->columns);
    }

    public function setReload($seconds)
    {
        $this->reload = $seconds;
        return $this;
    }

    public function view($ajax, ...$columnNames)
    {
        $columns = $this->get();
        $reload = $this->reload;
        return view('misc.table', compact('columns', 'ajax', 'columnNames', 'reload'))->render();
    }

}
