<?php
namespace App\DataProvider\Concern;

use Illuminate\Http\Request;
use App\DataProvider\Concern\TransformerInterface;

/**
 * Provider interface
 */
interface ProviderInterface {

    /**
     * Set Request
     *
     * @param \Illuminate\Http\Request $request
     * @return ProviderInterface
     */
    public function setRequest(Request $request):ProviderInterface;

    /**
     * Set Filters
     *
     * @param array $filterConfig
     * @return ProviderInterface
     */
    public function setFilterConfig(array $filterConfig=[]):ProviderInterface;

    /**
     * Get Data
     *
     * @return array
     */
    public function getData():array;

    /**
     *  Empty Data
     *
     * @return ProviderInterface
     */
    public function emptyData():ProviderInterface;

    /**
     * Transform Item
     *
     * @param object $item
     * @return TransformerModel
     */
    public function transformItem(object $item):TransformerModel;

    /**
     * Get Transformer
     *
     * @return TransformerInterface
     */
    public function getTransformer():TransformerInterface;

}