<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;

class CustomerRepository extends AppBaseRepository
{
    public function model()
    {
        return Customer::class;
    }

    public function getALlCustomers(Request $request, $perPage = 10, $archived = false)
    {
        $this->scopeQuery(function (\Illuminate\Database\Eloquent\Model $model) use ($request, $perPage, $archived) {
            return $model;
        });

        $this->pushCriteria(app(RequestCriteria::class));
        return $this->paginate($perPage);
    }
}
