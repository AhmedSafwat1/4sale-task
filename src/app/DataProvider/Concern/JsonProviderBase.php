<?php

namespace App\DataProvider\Concern;

use JsonMachine\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\DataProvider\Concern\TransformerModel;
use App\DataProvider\Concern\ProviderInterface;
use App\DataProvider\Concern\TransformerInterface;
use App\DataProvider\Models\UserModel;

/**
 * JsonProviderBase class
 */
abstract class JsonProviderBase implements ProviderInterface
{
    protected array $data = [];
    protected array $filters = [];
    protected ?Request $request = null;
    protected ?TransformerInterface $transformer = null;

    protected array $filterConfig = [
    ];

    /**
     * Set Filters
     *
     * @param array $filterConfig
     * @return ProviderInterface
     */
    public function setFilterConfig(array $filterConfig = []): ProviderInterface
    {
        $this->filterConfig = $filterConfig;
        return $this;
    }

    abstract public function getFilePath();

    /**
     * Transform Item
     *
     * @param object $item
     * @return TransformerModel
     */
    public function transformItem(object $item): TransformerModel
    {
        return $this->getTransformer()->transform($item);
    }

    abstract public function getTransformerClass(): string;

    /**
     * Set Request
     *
     * @param \Illuminate\Http\Request $request
     * @return ProviderInterface
     */
    public function setRequest(Request $request): ProviderInterface
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Set Filters
     *
     * @return void
     */
    protected function setFilters()
    {
        foreach ($this->filterConfig as $key => $filterClass) {
            if($this->request->has($key)) {
                $this->filters[] = new $filterClass();
            }
        }
        return $this;
    }

    /**
     * Get Data
     *
     * @return array
     */
    public function getData(): array
    {
        $this->setFilters();
        if(config("data.allow_cache")) {
            $this->getDataFromCache();
        } else {
            $this->getDataFromFile();
        }
        return $this->data;
    }

    /**
     *  Empty Data
     *
     * @return ProviderInterface
     */
    public function emptyData(): ProviderInterface
    {
        $this->data = [];
        return $this;
    }

    /**
     * Get Transformer
     *
     * @return TransformerInterface
     */
    public function getTransformer(): TransformerInterface
    {
        if(!$this->transformer) {
            $this->transformer = new ($this->getTransformerClass());
        }
        return $this->transformer;
    }

    /**
     * GetData
     *
     * @return void
     */
    protected function getDataFromFile()
    {

        $this->data = $this->readData();
        return $this;
    }

    /**
     * Read Data
     *
     * @return array of UserModel
     */
    protected function readData(): array
    {
        $out     = [];
        $origin  = Items::fromFile($this->getFilePath());
        foreach ($origin as $item) {
            $item  = $this->transformItem($item);
            if($this->checkFilter($item)) {
                $out[] = $item;
            }

        }
        return $out;
    }

    /**
     * Check Filter
     *
     * @param UserModel $item
     * @return boolean
     */
    protected function checkFilter(UserModel $item): bool
    {
        if(count($this->filters) == 0) {
            return true;
        }

        foreach ($this->filters as $filter) {
            if($filter->itemIsValid($item, $this->request) == false) {
                return false;
            }
        }
        return true;
    }

    public function getDataFromCache()
    {
        $this->data = Cache::rememberForever($this->getCacheKey(), function () {
            return $this->readData();
        });
        return $this;
    }

    public function getCacheKey()
    {
        return 'f-'.md5(
            "{$this->getFilePath()}-{$this->request->getRequestUri()}"
        );
    }

}
