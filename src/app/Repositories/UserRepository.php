<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\DataProvider\Filters\StatusCodeFilter;
use App\Repositories\Concern\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Provider which  get data from it can add new provider here but implements ProviderInterface
     *
     * @var array of ProviderInterface
     */
    protected $dataProviders = [
        "DataProviderX" => \App\DataProvider\DataProviderX::class ,
        "DataProviderY" => \App\DataProvider\DataProviderY::class
    ];

    /**
     * Can add any new filters her but new filter must implements IFilter interface
     *
     * @var array of IFilter
     */
    protected $filterConfig = [
        "statusCode" =>  \App\DataProvider\Filters\StatusCodeFilter::class ,
        "currency"   => \App\DataProvider\Filters\CurrencyFilter::class ,
        "balanceMin" => \App\DataProvider\Filters\BalanceMinFilter::class,
        "balanceMax" => \App\DataProvider\Filters\BalanceMaxFilter::class
    ];

    /**
     * Get Users
     *
     * @param Request $request
     * @return array
     */
    public function getUsers(Request $request): array
    {
        return $this->collectDataFromProviders($request);
    }

    protected function collectDataFromProviders($request):array
    {
        if($request->provider && isset($this->dataProviders[$request->provider])) {
            return (new $this->dataProviders[$request->provider]())
                   ->setRequest($request)
                   ->setFilterConfig($this->filterConfig)
                   ->getData()
            ;
        }

        $data = [];
        foreach ($this->dataProviders as $provider) {
            $data =  array_merge(
                $data,
                (new $provider())
                 ->setRequest($request)
                 ->setFilterConfig($this->filterConfig)
                 ->getData()
            );
        }
        return $data;
    }

}
