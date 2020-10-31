<?php


namespace RServices\Helpers\Crud;


use Illuminate\Support\Str;

class FormContractBuilder
{

    public static function create(bool $translatable = true)
    {
        return new static($translatable);
    }

    private $inputs;
    private $col;
    private $translatable;

    public function __construct(bool $translatable)
    {
        $this->inputs = '';
        $this->col = 'col';
        $this->translatable = $translatable;
    }

    public function make($action = null, $submitTitle = null, $method = 'POST')
    {
        return view('misc.crud.form', array_merge(get_defined_vars(), [
            'slot' => $this->inputs,
        ]));
    }

    public function makeFrom($model, $source = null, $action = null, $submitTitle = null, $method = 'POST')
    {
        $this->addFromArray($model::$formFields, $source);
        return $this->make($action, $submitTitle, $method);
    }

    public function addSelect($name, $label, array $options, $value = null, $col = null, $nullable = false)
    {
        $this->inputs .= view('misc.crud.form-group-select', array_merge(get_defined_vars(), ['col' => $col ? (is_numeric($col) ? "col-$col" : $col) : $this->col]))->render();
        return $this;
    }

    public function addRelation($name, $label, array $options, $value = null, $col = null, $nullable = false)
    {
        $this->inputs .= view('misc.crud.form-group-select', array_merge(get_defined_vars(), ['col' => $col ? (is_numeric($col) ? "col-$col" : $col) : $this->col]))->render();
        return $this;
    }

    public function addMultiRelation($name, $label, array $options, $values = null, $col = null, $nullable = false)
    {
        $this->inputs .= view('misc.crud.form-group-multi-select', array_merge(get_defined_vars(), ['col' => $col ? (is_numeric($col) ? "col-$col" : $col) : $this->col]))->render();
        return $this;
    }

    public function addTextarea($name, $label, $value = null, $col = null, $kind = null)
    {
        $this->inputs .= view('misc.crud.form-group-textarea', array_merge(get_defined_vars(), ['col' => $col ? (is_numeric($col) ? "col-$col" : $col) : $this->col]))->render();
        return $this;
    }

    public function add($name, $type, $label = null, $placeholder = null, $value = null, $min = null, $max = null, $step = null, $col = null, $nullable = false)
    {
        $this->inputs .= view('misc.crud.form-group', array_merge(get_defined_vars(), ['col' => $col ? (is_numeric($col) ? "col-$col" : $col) : $this->col]))->render();
        return $this;
    }

    public function addText($name, $label, $col = null, $value = null, $placeholder = null)
    {
        return $this->add($name, 'text', $label, $placeholder, $value, null, null, null, $col);
    }

    public function addRange($name, $label, $min, $max, $step = null, $placeholder = null, $value = null)
    {
        return $this->add($name, 'range', $label, $placeholder, $value, $min, $max, $step);
    }

    public function addNumber($name, $label, $placeholder = null, $value = null)
    {
        return $this->add($name, 'number', $label, $placeholder, $value);
    }

    public function addValue($name, $label, $value, $placeholder = null)
    {
        return $this->add($name, 'text', $label, $placeholder, $value);
    }

    public function addCheckbox($name, $label, $checked = false)
    {
        return $this->add($name, 'checkbox', $label, null, $checked ? 'checked' : null);
    }

    public function setCol(string $col)
    {
        $this->col = $col;
        return $this;
    }

    public function addFromArray(array $formFields, $source = null, $action = null, $submitTitle = null)
    {
        $obj = $source;
        $source = $source ? $source->toArray() : null;
        $kind = ($source ? 'create' : 'update');
        foreach ($formFields as $field) {
            $args = [];
            foreach (explode('|', $field) as $arg) {
                $k = ($values = explode(':', $arg, 2))[0];
                $v = $values[1];
                $args[$k] = $v;
            }
            $label = array_key_exists('label', $args) ? $args['label'] : ucwords(str_replace('_', ' ', $args['name']));
            if (array_key_exists('only', $args))
                if ($kind === $args['only']) continue;
            if ($args['type'] == 'select' && array_key_exists('options', $args))
                $this->addSelect($args['name'], $label,
                    $this->selectTransform($args['options']),
                    array_key_exists('value', $args) ? $args['value'] : ($source && array_key_exists($args['name'], $source) ? $source[$args['name']] : null),
                    array_key_exists('col', $args) ? $args['col'] : null, array_key_exists('nullable', $args));
            else if ($args['type'] == 'select' && array_key_exists('relation', $args)) {
                $valueKey = count($relationVars = explode(',', $args['relation'])) != 0 ? ($relationVars)[1] : 'id';
                $primaryKey = (isset($relationVars) && count($relationVars) == 3) ? $relationVars[2] : 'id';
                if (isset($relationVars)) $args['relation'] = $relationVars[0];
                $this->addRelation(
                    $args['name'], $label,
                    $this->selectRelationTransform((model_path(str_replace(' ', '', ucwords(Str::snake($args['relation'], ' ')))))::all()->toArray(), $valueKey, $primaryKey),
                    array_key_exists('value', $args) ? $args['value'] : ($source && array_key_exists($args['name'], $source) ? $source[$args['name']] : null),
                    array_key_exists('col', $args) ? $args['col'] : null, array_key_exists('nullable', $args));
            } else if ($args['type'] == 'multiSelect' && array_key_exists('relation', $args)) {
                $valueKey = count($relationVars = explode(',', $args['relation'])) != 0 ? ($relationVars)[1] : 'id';
                $primaryKey = (isset($relationVars) && count($relationVars) == 3) ? $relationVars[2] : 'id';
                if (isset($relationVars)) $args['relation'] = $relationVars[0];
                $this->addMultiRelation(
                    $args['name'], $label,
                    $this->selectRelationTransform((model_path(str_replace(' ', '', ucwords(Str::snake($args['relation'], ' ')))))::all()->toArray(), $valueKey, $primaryKey),
                    is_object($obj) ? collect($obj->{Str::plural($args['relation'])})->map(fn($x) => $x[$primaryKey])->toArray() : ['X'],
                    array_key_exists('col', $args) ? $args['col'] : null, array_key_exists('nullable', $args));
            } else if ($args['type'] == 'textarea') {
                $this->addTextarea($args['name'], $label, array_key_exists('value', $args) ? $args['value'] : ($source && array_key_exists($args['name'], $source) ? $source[$args['name']] : null), array_key_exists('col', $args) ? $args['col'] : null, array_key_exists('kind', $args) ? $args['kind'] : null);
            } else $this->add($args['name'], $args['type'],
                $label,
                array_key_exists('placeholder', $args) ? $args['placeholder'] : null,
                array_key_exists('value', $args) ? $args['value'] : ($source && array_key_exists($args['name'], $source) ? $source[$args['name']] : null),
                array_key_exists('min', $args) ? $args['min'] : null,
                array_key_exists('max', $args) ? $args['max'] : null,
                array_key_exists('step', $args) ? $args['step'] : null,
                array_key_exists('col', $args) ? $args['col'] : null,
                array_key_exists('nullable', $args),
                );
        }
        return $this->make($action, $submitTitle);
    }

    function selectTransform($args)
    {
        $arr = [];
        $explode = explode(',', $args);
        foreach ($explode as $item) {
            $keys = explode(':', $item);
            if (count($keys) == 2)
                $arr[$keys[0]] = $keys[1];
            else
                $arr[$item] = $item;
        }
        return $arr;
    }

    function selectRelationTransform($args, $valueKey, $primaryKey = 'id')
    {
        $arr = [];
        foreach ($args as $item) $arr[$item[$primaryKey]] = $item[$valueKey];
        return $arr;
    }

    function multiSelectRelationTransform($args, $valueKey, $primaryKey = 'id')
    {
        $arr = [];
        foreach ($args as $item) $arr[$item[$primaryKey]] = $item[$valueKey];
        return $arr;
    }

}
