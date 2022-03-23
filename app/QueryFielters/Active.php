<?php

namespace App\QueryFielters;

use Closure;

class Active extends filters
{

    protected function applyFilter($builder)
    {
        return $builder->where('IsActive',request($this->filterName()));
    }
}
