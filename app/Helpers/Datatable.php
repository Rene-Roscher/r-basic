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
    private $columnNames;
    private $reload;
    private $serverSide;

    public function __construct()
    {
        $this->columns = [];
        $this->columnNames = [];
        $this->serverSide = null;
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
        if (!array_key_exists('action', $this->columnNames))
            $this->columnNames['action'] = '#';
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

    public function setServerSideProcessing()
    {
        $this->serverSide = true;
        return $this;
    }

    public function view($ajax, ...$columnNames)
    {
        if (count($this->columnNames) > 0)
            $columnNames = $this->columnNames;
        $columns = $this->get();
        $reload = $this->reload;
        $serverSide = $this->serverSide;
        return view('misc.table', compact('columns', 'ajax', 'columnNames', 'reload', 'serverSide'))->render();
    }

    /**
     * @param array $columnNames
     */
    public function setColumnNames(array $columnNames): void
    {
        $this->columnNames = $columnNames;
    }

    public function getColumnNames()
    {
        return json_encode($this->columnNames);
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns)
    {
        foreach ($columns as $column)
            $this->put($column);
        return $this;
    }

}
