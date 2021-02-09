<?php

namespace Modules\Dashboard\Services\Import;

use Illuminate\Support\Facades\Storage;

class SessionService {


	public static  function start($id)
	{
		session([$id.'.importing' => true]);
		session()->save();
	}

	public static  function end($id)
	{
		session([$id.'.importing' => false]);
		session()->save();
	}

	public static  function importing($id)
	{
		return session($id.'.importing', false);
	}

	public static  function message($id, $message = null)
	{
		if(is_null($message))
		{
			return session($id.'.message', 'N/A');
		} else {
			session([$id.'.message' => $message]);
			session()->save();
		}
	}

	public static  function widgets($id)
	{
		return collect(session($id.'.widgets', []));
	}

	public static  function widgetsAdd($id, $module, $method)
	{
		$widgets = self::widgets($id);	
		$widgets->push(['module' => $module, 'method' => $method]);
		session([$id.'.widgets' => $widgets->toArray()]);
	}	

	public static  function widgetsReset($id)
	{  
		session([$id.'.widgets' => []]);
	}

	public static  function clear($import_class)
	{
		Storage::delete('failures/'.$import_class);
		session()->forget($import_class.'.new');
		session()->forget($import_class.'.updated');
		session()->forget($import_class.'.failures');
		session()->forget($import_class.'.completed');
		session()->save();
	}

	public static  function new($import_class, $increment = false)
	{
		if($increment){
			session([$import_class.'.new' => (self::new($import_class)+1)]);
			session()->save();
		} else {
			return session($import_class.'.new', 0);
		}

	}

	public static  function updated($import_class, $increment = false, $report = null)
	{
		if($increment){
			session([$import_class.'.updated' => (self::updated($import_class)+1)]);
			session()->save();
			Storage::append('failures/'.$import_class, $report);
		} else {
			return session($import_class.'.updated', 0);
		}
	}	

	public static  function failures($import_class, $increment = false, $report = null)
	{
		if($increment){
			session([$import_class.'.failures' => (self::failures($import_class)+1)]);
			session()->save();
			Storage::append('failures/'.$import_class, $report);
		} else {
			return session($import_class.'.failures', 0);
		}
	}

	public static  function completed($import_class, $completed = null)
	{
		if(is_null($completed))
		{
			return floor(session($import_class.'.completed', 0));
		} else {
			session([$import_class.'.completed' => $completed]);
			session()->save();
		}
	}

	public static  function title($import_class, $title = null)
	{
		if(is_null($title))
		{
			return session($import_class.'.title', null);
		} else {
			session([$import_class.'.title' => $title]);
			session()->save();
		}
	}

}
