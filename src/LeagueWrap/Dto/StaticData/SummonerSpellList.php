<?php
namespace LeagueWrap\Dto\StaticData;

use LeagueWrap\Dto\AbstractListDto;

class SummonerSpellList extends AbstractListDto {

	protected $listKey = 'data';

	public function __construct(array $info)
	{
		if (isset($info['data']))
		{
			$spells = [];
			foreach ($info['data'] as $spellId => $spell)
			{
				$summonerSpellDto = new SummonerSpell($spell);
				$spells[$spellId] = $summonerSpellDto;
			}
			$info['data'] = $spells;
		}

		parent::__construct($info);
	}

	/**
	 * A quick short cut to get the summoner spells by id.
	 *
	 * @param int $spellId
	 * @return SummonerSpell|null
	 */
	public function getSpell($spellId)
	{
		if (isset($this->info['data'][$spellId]))
		{
			return $this->info['data'][$spellId];
		}

		return null;
	}

    /**
     * Get the the spell from the name
     * @param string $name
     *
     * @return SummonerSpell|null
     */
    public function getSpellFromName($name)
    {
        foreach($this->info['data'] as $id => $spell){
            if($spell['name'] == $name)
                return $this->info['data'][$id];
		}
        return null;
    }
}
