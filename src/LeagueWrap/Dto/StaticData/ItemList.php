<?php
namespace LeagueWrap\Dto\StaticData;

use LeagueWrap\Dto\AbstractListDto;

class ItemList extends AbstractListDto {

	protected $listKey = 'data';

	/**
	 * Set up the information about the ItemList Dto.
	 *
	 * @param array $info
	 */
	public function __construct(array $info)
	{
		if (isset($info['data']))
		{
			$data = [];
			foreach ($info['data'] as $itemId => $item)
			{
				$itemDto       = new Item($item);
				$data[$itemId] = $itemDto;
			}
			$info['data'] = $data;
		}
		if (isset($info['basic']))
		{
			$info['basic'] = new BasicData($info['basic']);
		}
		if (isset($info['groups']))
		{
			$groups = [];
			foreach ($info['groups'] as $itemId => $group)
			{
				$groupDto        = new Group($group);
				$groups[$itemId] = $groupDto;
			}
			$info['groups'] = $groups;
		}
		if (isset($info['tree']))
		{
			$tree = [];
			foreach ($info['tree'] as $itemId => $tree)
			{
				$itemTreeDto   = new ItemTree($tree);
				$tree[$itemId] = $itemTreeDto;
			}
			$info['tree'] = $tree;
		}

		parent::__construct($info);
	}

	/**
	 * Quick shortcut to get an item information by $itemId
	 *
	 * @param int $itemId
	 * @return Item|null
	 */
	public function getItem($itemId)
	{
		if (isset($this->info['data'][$itemId]))
		{
			return $this->info['data'][$itemId];
		}

		return null;
	}

    /**
     * Sort the itemList by Gold and if they have the same gold amount, then sort by Name
     */
	public function sortByGoldAndName()
    {
        usort($this->info['data'], function($a, $b){
            if ($a->get('gold')->get('total') == $b->get('gold')->get('total')) {
                if($a->get('name') == $b->get('name')){
                    return 0;
                }else{
                    return ($a->get('name') < $b->get('name')) ? -1 : 1;
                }
            }
            return ($a->get('gold') < $b->get('gold')) ? -1 : 1;
        });
    }
}
