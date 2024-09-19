?<?php
  // app/Extensions/CustomBuilder.php

  namespace App\Extensions;

  use Illuminate\Database\Query\Builder as BaseBuilder;

  class CustomBuilder extends BaseBuilder
  {
    /**
     * Add a left join to the query based on a condition.
     *
     * @param bool $condition
     * @param string $table
     * @param \Closure|string $first
     * @param string|null $operator
     * @param string|null $second
     * @param string $type
     * @param bool $where
     * @return $this
     */
    public function leftJoinWhen($condition, $table, $first, $operator = null, $second = null, $type = 'left', $where = false)
    {
      if ($condition) {
        return $this->leftJoin($table, $first, $operator, $second, $type, $where);
      }

      return $this;
    }
  }
