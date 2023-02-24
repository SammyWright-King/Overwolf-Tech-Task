<?php

namespace App\Interfaces;

interface SearchInterface
{
    /**
     * @param int $userId
     * @return mixed
     * lookup minecraft using user id
     */
    public function lookupMinecraftById($userId);

    /**
     * @param string $username
     * @return mixed
     * lookup minecraft using username
     */
    public function lookupMinecraftByUsername(string $username);

    /**
     * @param int $id
     * @return mixed
     * lookup steam using user id
     */
    public function lookupSteamById($id);

    /**
     * @param string $username
     * @return mixed
     * lookup xbl using username
     */
    public function lookupXBLByUsername(string $username);

    /**
     * @param int $id
     * @return mixed
     * lookup xbl using user id
     */
    public function lookupXBLById($id);
}
