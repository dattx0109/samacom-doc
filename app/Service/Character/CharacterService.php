<?php


namespace App\Service\Character;


use App\Repository\Character\CharacterRepository;

class CharacterService
{
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function getList()
    {
        return $this->characterRepository->getList();
    }
}
