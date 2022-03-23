<?php

namespace App\QueryFielters;

use Closure;

class Sort extends filters
{



    protected function applyFilter($builder)
    {
        return $builder->orderBy('title', request($this->filterName()));
    }
}
