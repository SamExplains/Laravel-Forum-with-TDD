<?php

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
  /**
   * @var Request
   */
  protected $request, $builder;
  protected $filters = [];

  /**
   * ThreadFilter constructor.
   * @param Request $request
   */
  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  /**
   * @param $builder
   * @return mixed
   */
  public function apply($builder)
  {

    $this->builder = $builder;

//    foreach ($this->filters as $filter) {
    foreach ($this->getFilters() as $filter => $value) {

      if (method_exists($this, $filter) && !is_null($filter)) {
        $this->$filter($value);
      }

    }

    return $this->builder;
  }

  /**
   *
   */
  public function getFilters(){
    return $this->request->only($this->filters);
  }

}