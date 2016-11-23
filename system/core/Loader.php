<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader {

	private $_models = array();
	public function model($model, $name = '')
	{
		if (empty($model)) {
			return $this;
		}
		else if (is_array($model)) {
			foreach ($model as $key => $value) {
				if (is_int($key)) {
					$this->model($value);
				}
				else {
					$this->model($key, $value);
				}
			}
		}

		if (empty($name)) {
			$name = $model;
		}

		$it = get_instance();
		if (isset($this->_models) && in_array($name, $this->_models, TRUE)) {
			$it->$name = $this->_model[$name];
			return $this;
		}

		if (isset($this->$name)) {
			throw new RuntimeException('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		if (!class_exists('Model')) {
			load_class('Model', 'core');
		}

		$model = ucfirst($model);
		if (!class_exists($model)) {
			if (!file_exists(APPPATH.'models/'.$model.'.php')) {
				throw new RuntimeException('Unable to locate the model you have specified: '.$model);
			}
			require_once APPPATH.'models/'.$model.'.php';
			if ( ! class_exists($model, FALSE)) {
				throw new RuntimeException(APPPATH.'models/'.$model.".php exists, but doesn't declare class ".$model);
			}
		}
		else if (!is_subclass_of($model, 'Model'))
		{
			throw new RuntimeException("Class ".$model." already exists and doesn't extend Model");
		}
		$it->$name = new $model();
		$it->$name->load = $this;
		$this->_models[$name] = $it->$name;
		return $this;
	}

	public function view($view, $para = array())
	{
		include VIEWPATH.'header.php';
		include VIEWPATH.$view.'.php';
		include VIEWPATH.'footer.php';
	}
	public function view_once($view, $para = array())
	{
		include VIEWPATH.$view.'.php';
	}
}