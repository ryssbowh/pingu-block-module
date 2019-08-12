<?php 

namespace Pingu\Block\Contracts;

use Pingu\Core\Contracts\Models\HasAdminRoutesContract;
use Pingu\Core\Contracts\Models\HasAjaxRoutesContract;
use Pingu\Forms\Contracts\Models\FormableContract;

interface CreatableBlockContract extends BlockContract, FormableContract
{
	public static function blockSlug();
}