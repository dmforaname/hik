<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface
 *
 * @package App\Repositories
 */
interface RepositoryInterface
{
    /**
     * @param  array  $attributes
     * 
     * @return mixed
     */
    public function save(array $attributes);

    /**
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * @return mixed
     */
    public function query();

    /**
     * @param  string  $attributes
     *
     * @return mixed
     */
    public function uuid(string $param);
}