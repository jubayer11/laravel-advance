<?php

namespace App\QueryFielters;

class MaxCount extends filters
{

    protected function applyFilter($builder)
    {
        return $builder->take(request($this->filterName()));
    }
}
